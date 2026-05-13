<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Nije dozvoljena ova metoda.']);
    exit;
}

$input = file_get_contents('php://input');
$podaci = json_decode($input, true);

if (!$podaci) {
    echo json_encode(['success' => false, 'message' => 'Nevalidni podaci.']);
    exit;
}

$greske = [];

$ime = trim($podaci['ime'] ?? '');
$slova = '/^[\p{L}\s]+$/u';
if (empty($ime)) {
    $greske[] = 'Ime je obavezno.';
} elseif (!preg_match($slova, $ime)) {
    $greske[] = 'Ime sme sadržati samo slova.';
}

$prezime = trim($podaci['prezime'] ?? '');
if (empty($prezime)) {
    $greske[] = 'Prezime je obavezno.';
} elseif (!preg_match($slova, $prezime)) {
    $greske[] = 'Prezime sme sadržati samo slova.';
}

$godina = intval($podaci['godina'] ?? 0);
$trenutnaGodina = intval(date('Y'));
if (empty($podaci['godina'])) {
    $greske[] = 'Godina rođenja je obavezna.';
} elseif ($godina > $trenutnaGodina ) {
    $greske[] = 'Godina rođenja ne može biti veća od trenutne godine.';
}

$adresa = trim($podaci['adresa'] ?? '');
if (empty($adresa)) {
    $greske[] = 'Adresa je obavezna.';
}

$gradoviDozvoljeni = [
    'Beograd', 'Novi Sad', 'Niš', 'Kragujevac', 'Subotica',
    'Zrenjanin', 'Pančevo', 'Čačak', 'Novi Pazar', 'Kraljevo',
    'Kruševac', 'Leskovac', 'Valjevo', 'Vranje', 'Šabac'
];

$grad = trim($podaci['grad'] ?? '');
if (empty($grad) || !in_array($grad, $gradoviDozvoljeni)) {
    $greske[] = 'Izaberite validan grad.';
}

$polDozvoljeni = ['Muški', 'Ženski', 'Drugo'];
$pol = trim($podaci['pol'] ?? '');
if (empty($pol) || !in_array($pol, $polDozvoljeni)) {
    $greske[] = 'Izaberite validan pol.';
}

if (!empty($greske)) {
    echo json_encode(['success' => false, 'message' => implode(' ', $greske)]);
    exit;
}

echo json_encode(['success' => true, 'message' => 'Registracija uspešna!']);