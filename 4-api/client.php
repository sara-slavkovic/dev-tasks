<?php
require_once 'config.php';

class KorisnikKlijent {
    
    private $apiUrl;
    private $apiKey;
    
    public function __construct() {
        $this->apiUrl = 'http://localhost/dev_tasks/4-api/api_register.php';
        $this->apiKey = API_KEY;
    }
    
    public function registrujKorisnika($podaci) {
        $json = json_encode($podaci);
        
        $ch = curl_init($this->apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'X-API-Key: ' . $this->apiKey
        ]);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        return [
            'http_code' => $httpCode,
            'response' => json_decode($response, true)
        ];
    }
}

$klijent = new KorisnikKlijent();

$noviKorisnik = [
    'firstname' => 'Anastasija',
    'lastname' => 'Stanić',
    'email' => 'anastasija@email.com',
    'phone' => '0611234567',
    'username' => 'anastasijas',
    'password' => 'lozinka123',
    'city' => 'Beograd',
    'postal_code' => '11000',
    'address' => 'Jurija Gagarina 212'
];

$rezultat = $klijent->registrujKorisnika($noviKorisnik);

header('Content-Type: application/json');
echo json_encode($rezultat, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);