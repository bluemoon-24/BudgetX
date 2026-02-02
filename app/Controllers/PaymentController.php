<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Payment;
use App\Models\User;

class PaymentController extends Controller
{
    /**
     * Display the Upgrade to Premium pricing page
     */
    public function upgrade()
    {
        // Ensure user is logged in
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        // Mock Stripe Config for view
        $data = [
            'stripe_key' => 'pk_test_sample', // Replace with real key
            'price_id' => 'price_sample'      // Replace with real price
        ];

        $this->view('upgrade', $data);
    }

    /**
     * Start the payment process - redirects to Stripe Sandbox
     */
    public function process()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        $this->view('stripe_checkout');
    }

    /**
     * Create a Stripe charge via API
     */
    public function createCharge()
    {
        header('Content-Type: application/json');

        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
            return;
        }

        $userId = $_SESSION['user_id'];
        $planType = $_POST['plan_type'] ?? 'MONTHLY';
        $token = $_POST['stripe_token'] ?? null;

        // Prices in cents (e.g., 550.00 -> 55000)
        $amount = ($planType === 'ANNUAL') ? 600000 : 55000;

        if (!$token) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid payment token']);
            return;
        }

        // Stripe API Secret Key from .env
        $secretKey = \App\Core\Env::get('STRIPE_SECRET_KEY', 'sk_test_sample');

        // Native CURL to create a charge
        $ch = curl_init('https://api.stripe.com/v1/charges');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $secretKey . ':');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'amount' => $amount,
            'currency' => 'usd',
            'source' => $token,
            'description' => "BudgetX Premium $planType Subscription",
            'metadata' => ['user_id' => $userId]
        ]));

        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            echo json_encode(['status' => 'error', 'message' => 'CURL Error: ' . $err]);
            return;
        }

        $result = json_decode($response, true);

        if (isset($result['error'])) {
            echo json_encode(['status' => 'error', 'message' => $result['error']['message']]);
            return;
        }

        // Success! Update user and record payment
        $userModel = new \App\Models\User();
        $paymentModel = new \App\Models\Payment();
        $subscriptionModel = new \App\Models\Subscription();

        $startDate = date('Y-m-d H:i:s');
        $endDate = date('Y-m-d H:i:s', strtotime($planType === 'ANNUAL' ? '+1 year' : '+1 month'));

        if ($subscriptionModel->updateSubscription($userId, 'ACTIVE', $startDate, $endDate)) {
            $paymentModel->add($userId, $result['id'], $amount / 100, 'completed');
            $_SESSION['role'] = 'premium';

            echo json_encode([
                'status' => 'success',
                'message' => 'Payment processed successfully',
                'subscription_status' => 'ACTIVE',
                'charge_id' => $result['id']
            ]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Internal database error']);
        }
    }

    /**
     * Retrieve payment history for the user
     */
    public function history()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        $paymentModel = new \App\Models\Payment();
        $history = $paymentModel->getHistory($_SESSION['user_id']);

        $this->view('payment_history', ['history' => $history]);
    }

    /**
     * Handle payment cancellation
     */
    public function cancel()
    {
        $this->redirect('/BudgetX/public/user/dashboard_basic');
    }
}


