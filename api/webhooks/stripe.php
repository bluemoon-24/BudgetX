<?php
require_once __DIR__ . '/../bootstrap.php';
use App\Controllers\WebhookController;

$controller = new WebhookController();
$controller->handle();
