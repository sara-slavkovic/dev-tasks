<?php
class Order {
    private $id;
    private $userId;
    private $value;
    private $dateCreate;
    private $items = [];
    private $user;

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getUserId() { return $this->userId; }
    public function setUserId($userId) { $this->userId = $userId; }

    public function getValue() { return $this->value; }
    public function setValue($value) { $this->value = $value; }

    public function getDateCreate() { return $this->dateCreate; }
    public function setDateCreate($dateCreate) { $this->dateCreate = $dateCreate; }

    public function getItems() { return $this->items; }
    public function setItems($items) { $this->items = $items; }
    public function addItem($item) { $this->items[] = $item; }

    public function getUser() { return $this->user; }
    public function setUser($user) { $this->user = $user; }
}