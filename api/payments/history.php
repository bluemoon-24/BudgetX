<?php
require_once __DIR__ . '/../bootstrap.php';
use App\Models\Payment;

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit();
}

$paymentModel = new Payment();
$history = $paymentModel->getHistory($_SESSION['user_id']);

echo json_encode([
    'status' => 'success',
    'data' => $history
]);
