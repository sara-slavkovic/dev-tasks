<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository-interfaces/IUserRepository.php';

class UserRepository implements IUserRepository {
    
    private $conn;
    
    public function __construct() {
        $this->conn = getConnection();
    }
    
    public function findByEmail($email) {
        $stmt = $this->conn->prepare('SELECT id FROM User WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
        $postoji = $stmt->num_rows > 0;
        $stmt->close();
        return $postoji;
    }
    
    public function save(User $user) {
        $firstname = $user->getFirstname();
        $lastname = $user->getLastname();
        $email = $user->getEmail();
        $phone = $user->getPhone();
        $username = $user->getUsername();
        $password = $user->getPassword();
        $city = $user->getCity();
        $postal_code = $user->getPostalCode();
        $address = $user->getAddress();
        
        $stmt = $this->conn->prepare(
            'INSERT INTO User (firstname, lastname, phone, email, username, password, city, postal_code, address) 
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)'
        );
        $stmt->bind_param('sssssssss', $firstname, $lastname, $phone, $email, $username, $password, $city, $postal_code, $address);
        $stmt->execute();
        
        $id = $stmt->affected_rows > 0 ? $this->conn->insert_id : null;
        $stmt->close();
        return $id;
    }
    
    public function __destruct() {
        $this->conn->close();
    }
}