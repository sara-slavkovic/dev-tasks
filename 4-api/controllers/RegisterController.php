<?php
require_once __DIR__ . '/../services/UserService.php';
require_once __DIR__ . '/../repositories/UserRepository.php';

class RegisterController {
    
    private $userService;
    
    public function __construct() {
        $this->userService = new UserService(new UserRepository());
    }
    
    public function register() {
        try {
            $apiKey = $_SERVER['HTTP_X_API_KEY'] ?? '';
            $input = file_get_contents('php://input');
            $podaci = json_decode($input, true);
            
            $rezultat = $this->userService->register($podaci, $apiKey);
            
            http_response_code(201);
            echo json_encode($rezultat, JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            http_response_code($e->getCode());
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ], JSON_UNESCAPED_UNICODE);
        }
    }
}