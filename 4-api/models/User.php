<?php
class User {
    private $id;
    private $firstname;
    private $lastname;
    private $email;
    private $phone;
    private $username;
    private $password;
    private $city;
    private $postal_code;
    private $address;

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getFirstname() { return $this->firstname; }
    public function setFirstname($firstname) { $this->firstname = $firstname; }

    public function getLastname() { return $this->lastname; }
    public function setLastname($lastname) { $this->lastname = $lastname; }

    public function getEmail() { return $this->email; }
    public function setEmail($email) { $this->email = $email; }

    public function getPhone() { return $this->phone; }
    public function setPhone($phone) { $this->phone = $phone; }

    public function getUsername() { return $this->username; }
    public function setUsername($username) { $this->username = $username; }

    public function getPassword() { return $this->password; }
    public function setPassword($password) { $this->password = $password; }

    public function getCity() { return $this->city; }
    public function setCity($city) { $this->city = $city; }

    public function getPostalCode() { return $this->postal_code; }
    public function setPostalCode($postal_code) { $this->postal_code = $postal_code; }

    public function getAddress() { return $this->address; }
    public function setAddress($address) { $this->address = $address; }
}