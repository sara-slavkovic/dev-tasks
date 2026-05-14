<?php
require_once __DIR__ . '/../services/OrderService.php';
require_once __DIR__ . '/../repositories/OrderRepository.php';

class OrdersController {
    
    private $orderService;
    
    public function __construct() {
        $this->orderService = new OrderService(new OrderRepository());
    }
    
    public function getOrders() {
        try {
            $rezultat = $this->orderService->getAllOrders();
            
            http_response_code(200);
            echo json_encode($rezultat, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            http_response_code($e->getCode());
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ], JSON_UNESCAPED_UNICODE);
        }
    }
}