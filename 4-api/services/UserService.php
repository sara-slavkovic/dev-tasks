<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repositories/UserRepository.php';
require_once __DIR__ . '/../repository-interfaces/IUserRepository.php';
require_once __DIR__ . '/../service-interfaces/IUserService.php';
require_once __DIR__ . '/../config.php';

class UserService implements IUserService {
    
    private $userRepository;
    
    public function __construct(IUserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }
    
    private function verifyApiKey($apiKey) {
        if ($apiKey !== API_KEY) {
            throw new Exception('Neautorizovan pristup. Neispravan API ključ.', 401);
        }
    }
    
    private function validateData($podaci) {
        $greske = [];
        
        $ime = trim($podaci['firstname'] ?? '');
        if (empty($ime)) $greske[] = 'Ime je obavezno.';
        
        $prezime = trim($podaci['lastname'] ?? '');
        if (empty($prezime)) $greske[] = 'Prezime je obavezno.';
        
        $email = trim($podaci['email'] ?? '');
        if (empty($email)) {
            $greske[] = 'Email je obavezan.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $greske[] = 'Email nije validan.';
        }
        
        $telefon = trim($podaci['phone'] ?? '');
        if (empty($telefon)) $greske[] = 'Telefon je obavezan.';
        
        $username = trim($podaci['username'] ?? '');
        if (empty($username)) $greske[] = 'Username je obavezan.';
        
        $password = trim($podaci['password'] ?? '');
        if (empty($password)) $greske[] = 'Lozinka je obavezna.';
        
        $city = trim($podaci['city'] ?? '');
        if (empty($city)) $greske[] = 'Grad je obavezan.';
        
        $postal_code = trim($podaci['postal_code'] ?? '');
        if (empty($postal_code)) $greske[] = 'Poštanski broj je obavezan.';
        
        $address = trim($podaci['address'] ?? '');
        if (empty($address)) $greske[] = 'Adresa je obavezna.';
        
        if (!empty($greske)) {
            throw new Exception(implode(' ', $greske), 400);
        }
    }
    
    public function register($podaci, $apiKey) {
        $this->verifyApiKey($apiKey);
        
        if (!$podaci) {
            throw new Exception('Nevalidni podaci.', 400);
        }
        
        $this->validateData($podaci);
        
        if ($this->userRepository->findByEmail(trim($podaci['email']))) {
            throw new Exception('Korisnik sa ovim emailom već postoji.', 409);
        }
        
        $user = new User();
        $user->setFirstname(trim($podaci['firstname']));
        $user->setLastname(trim($podaci['lastname']));
        $user->setEmail(trim($podaci['email']));
        $user->setPhone(trim($podaci['phone']));
        $user->setUsername(trim($podaci['username']));
        $user->setPassword(password_hash(trim($podaci['password']), PASSWORD_BCRYPT));
        $user->setCity(trim($podaci['city']));
        $user->setPostalCode(trim($podaci['postal_code']));
        $user->setAddress(trim($podaci['address']));
        
        $noviId = $this->userRepository->save($user);
        
        if (!$noviId) {
            throw new Exception('Greška pri snimanju korisnika.', 500);
        }
        
        return ['success' => true, 'message' => 'Korisnik uspešno registrovan.', 'user_id' => $noviId];
    }
}