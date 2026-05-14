<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once 'controllers/OrdersController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Samo GET metoda je dozvoljena.']);
    exit;
}

$controller = new OrdersController();
$controller->getOrders();