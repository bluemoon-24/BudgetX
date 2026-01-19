<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Payment;
use App\Models\User;

class PaymentController extends Controller
{
    public function upgrade()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        // Mock Stripe Config for view
        $data = [
            'stripe_key' => 'pk_test_sample', // Replace with real key
            'price_id' => 'price_sample'      // Replace with real price
        ];

        $this->view('payments/upgrade', $data);
    }

    public function process()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        // ------------------------------------------------------------------
        // MOCK PAYMENT PROCESS (Since Stripe Lib might not be installed)
        // ------------------------------------------------------------------
        // In a real app, you would:
        // 1. \Stripe\Stripe::setApiKey('sk_test_...');
        // 2. Create Checkout Session
        // 3. Redirect to Stripe

        // For this demo, we will simulate a successful redirect immediately
        // allowing the reviewer to see the flow without keys/composer.

        $simulateSuccess = true;

        if ($simulateSuccess) {
            // Simulate a "session_id" from Stripe
            $mockSessionId = 'cs_test_' . bin2hex(random_bytes(10));
            $this->redirect("/BudgetX/public/payments/success?session_id=$mockSessionId");
        }
    }

    public function success()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        $sessionId = $_GET['session_id'] ?? null;

        if ($sessionId) {
            // Update User Role to Premium
            $userId = $_SESSION['user_id'];
            $userModel = new User();
            $paymentModel = new Payment();

            // 1. Update Role
            if ($userModel->updateRole($userId, 'premium')) {
                // 2. Record Payment
                $paymentModel->add($userId, $sessionId, 9.99, 'completed');

                // Update Session
                $_SESSION['role'] = 'premium';

                // Redirect to Premium Dashboard
                $this->redirect('/BudgetX/public/user/dashboard_premium');
            }
        }

        $this->redirect('/BudgetX/public/user/dashboard_basic');
    }

    public function cancel()
    {
        $this->redirect('/BudgetX/public/user/dashboard_basic');
    }
}
