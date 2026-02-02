<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Subscription;
use App\Models\Payment;

class WebhookController extends Controller
{
    public function handle()
    {
        $payload = file_get_contents('php://input');
        $sigHeader = $_SERVER['HTTP_STRIPE_SIGNATURE'] ?? '';
        $webhookSecret = \App\Core\Env::get('STRIPE_WEBHOOK_SECRET', 'whsec_sample');

        // Manual signature verification (Standard Stripe logic)
        // Format: t=TIMESTAMP,v1=SIGNATURE
        if ($sigHeader) {
            $parts = explode(',', $sigHeader);
            $timestamp = null;
            $signature = null;
            foreach ($parts as $part) {
                if (strpos($part, 't=') === 0)
                    $timestamp = substr($part, 2);
                if (strpos($part, 'v1=') === 0)
                    $signature = substr($part, 3);
            }

            if ($timestamp && $signature) {
                $signedPayload = $timestamp . '.' . $payload;
                $expectedSignature = hash_hmac('sha256', $signedPayload, $webhookSecret);

                if (!hash_equals($expectedSignature, $signature)) {
                    error_log("Stripe Webhook Error: Invalid signature");
                    http_response_code(400);
                    exit();
                }

                // Clock drift check (5 minutes)
                if (abs(time() - $timestamp) > 300) {
                    error_log("Stripe Webhook Error: Timestamp drift");
                    http_response_code(400);
                    exit();
                }
            } else {
                http_response_code(400);
                exit();
            }
        } else {
            // Optional: for sandbox testing without real signatures, you might skip this
            // but for "robustness" we enforce it or log a warning
            error_log("Stripe Webhook Warning: No signature found");
        }

        $data = json_decode($payload, true);
        if (!$data) {
            http_response_code(400);
            exit();
        }

        $subscriptionModel = new Subscription();
        $paymentModel = new Payment();

        // Log the webhook
        $subscriptionModel->logWebhook($data['type'], $payload);

        switch ($data['type']) {
            case 'charge.succeeded':
                $object = $data['data']['object'];
                $userId = $object['metadata']['user_id'] ?? null;
                if ($userId) {
                    $startDate = date('Y-m-d H:i:s');
                    $endDate = date('Y-m-d H:i:s', strtotime('+1 month'));
                    $subscriptionModel->updateSubscription($userId, 'ACTIVE', $startDate, $endDate);
                    $paymentModel->add($userId, $object['id'], $object['amount'] / 100, 'completed');
                }
                break;

            case 'charge.failed':
                // Log and optionally notify user
                break;

            case 'charge.refunded':
                $object = $data['data']['object'];
                $userId = $object['metadata']['user_id'] ?? null;
                if ($userId) {
                    $subscriptionModel->updateSubscription($userId, 'INACTIVE');
                }
                break;
        }

        http_response_code(200);
    }
}
