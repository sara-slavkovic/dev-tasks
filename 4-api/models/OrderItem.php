<?php
class OrderItem {
    private $id;
    private $orderId;
    private $productId;
    private $value;
    private $productName;
    private $productPrice;

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getOrderId() { return $this->orderId; }
    public function setOrderId($orderId) { $this->orderId = $orderId; }

    public function getProductId() { return $this->productId; }
    public function setProductId($productId) { $this->productId = $productId; }

    public function getValue() { return $this->value; }
    public function setValue($value) { $this->value = $value; }

    public function getProductName() { return $this->productName; }
    public function setProductName($productName) { $this->productName = $productName; }

    public function getProductPrice() { return $this->productPrice; }
    public function setProductPrice($productPrice) { $this->productPrice = $productPrice; }
}