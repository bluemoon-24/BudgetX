<?php
require_once __DIR__ . '/../bootstrap.php';
use App\Controllers\PaymentController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new PaymentController();
    $controller->createCharge();
} else {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Method Not Allowed']);
}
