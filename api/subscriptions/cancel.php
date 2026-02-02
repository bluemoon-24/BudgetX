<?php
require_once __DIR__ . '/../../bootstrap.php';
use App\Models\Subscription;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Method Not Allowed']);
    exit();
}

$userId = $_POST['user_id'] ?? ($_SESSION['user_id'] ?? null);

if (!$userId) {
    echo json_encode(['status' => 'error', 'message' => 'User ID required']);
    exit();
}

$subscriptionModel = new Subscription();
if ($subscriptionModel->cancel($userId)) {
    echo json_encode(['status' => 'success', 'message' => 'Subscription cancelled']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to cancel subscription']);
}
