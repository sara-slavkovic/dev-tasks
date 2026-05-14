<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../models/Order.php';
require_once __DIR__ . '/../models/OrderItem.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository-interfaces/IOrderRepository.php';

class OrderRepository implements IOrderRepository {
    
    private $conn;
    
    public function __construct() {
        $this->conn = getConnection();
    }
    
    public function findAll() {
        $sql = "
            SELECT 
                o.id AS order_id,
                o.value AS order_value,
                o.dateCreate AS order_date,
                u.firstname,
                u.lastname,
                u.email,
                oi.id AS item_id,
                oi.value AS item_value,
                p.name AS product_name,
                p.price AS product_price
            FROM `Order` o
            JOIN User u ON o.userId = u.id
            JOIN OrderItem oi ON oi.orderId = o.id
            JOIN Product p ON oi.productId = p.id
            ORDER BY o.id, oi.id
        ";
        
        $result = $this->conn->query($sql);
        if (!$result) return null;
        
        $porudzbine = [];
        
        while ($row = $result->fetch_assoc()) {
            $orderId = $row['order_id'];
            
            if (!isset($porudzbine[$orderId])) {
                $user = new User();
                $user->setFirstname($row['firstname']);
                $user->setLastname($row['lastname']);
                $user->setEmail($row['email']);
                
                $order = new Order();
                $order->setId($orderId);
                $order->setValue($row['order_value']);
                $order->setDateCreate($row['order_date']);
                $order->setUser($user);
                
                $porudzbine[$orderId] = $order;
            }
            
            $item = new OrderItem();
            $item->setId($row['item_id']);
            $item->setProductName($row['product_name']);
            $item->setProductPrice($row['product_price']);
            $item->setValue($row['item_value']);
            
            $porudzbine[$orderId]->addItem($item);
        }
        
        return array_values($porudzbine);
    }
    
    public function __destruct() {
        $this->conn->close();
    }
}