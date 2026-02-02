<?php
require_once __DIR__ . '/../../bootstrap.php';
use App\Models\Subscription;

header('Content-Type: application/json');

$userId = $_GET['user_id'] ?? ($_SESSION['user_id'] ?? null);

if (!$userId) {
    echo json_encode(['status' => 'error', 'message' => 'User ID required']);
    exit();
}

$subscriptionModel = new Subscription();
$status = $subscriptionModel->getStatus($userId);

if ($status) {
    echo json_encode([
        'status' => 'success',
        'subscription_status' => $status['subscription_status'],
        'end_date' => $status['subscription_end_date'],
        'role' => $status['role']
    ]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'User not found']);
}
