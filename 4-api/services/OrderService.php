<?php
require_once __DIR__ . '/../repositories/OrderRepository.php';
require_once __DIR__ . '/../repository-interfaces/IOrderRepository.php';
require_once __DIR__ . '/../service-interfaces/IOrderService.php';

class OrderService implements IOrderService {
    
    private $orderRepository;
    
    public function __construct(IOrderRepository $orderRepository) {
        $this->orderRepository = $orderRepository;
    }
    
    public function getAllOrders() {
        $orders = $this->orderRepository->findAll();
        
        if ($orders === null) {
            throw new Exception('Greška pri dohvatanju podataka.', 500);
        }
        
        $result = [];
        foreach ($orders as $order) {
            $items = [];
            foreach ($order->getItems() as $item) {
                $items[] = [
                    'id' => $item->getId(),
                    'product' => $item->getProductName(),
                    'price' => $item->getProductPrice(),
                    'value' => $item->getValue()
                ];
            }
            
            $result[] = [
                'id' => $order->getId(),
                'value' => $order->getValue(),
                'date' => $order->getDateCreate(),
                'user' => [
                    'firstname' => $order->getUser()->getFirstname(),
                    'lastname' => $order->getUser()->getLastname(),
                    'email' => $order->getUser()->getEmail()
                ],
                'items' => $items
            ];
        }
        
        return [
            'success' => true,
            'count' => count($result),
            'orders' => $result
        ];
    }
}