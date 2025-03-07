<?php
session_start(); // OBAVEZNO dodati na početku
require_once 'core/connection.php'; 

// Provera da li je korisnik ulogovan
if (!isset($_SESSION['user_id'])) {
    die('Greška: Niste ulogovani!');
}

// Ako je ulogovan, uzimamo podatke korisnika
$user_id = $_SESSION['user_id'];
echo "✅ Ulogovani ste kao korisnik sa ID: " . $user_id;


// Ako je korisnik tražio brisanje
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Proveravamo da li korisnik može da obriše (ako je admin ili neko s pravima)
    $stmt = $pdo->prepare("DELETE FROM users WHERE ID = :id");
    $stmt->bindParam(':id', $delete_id);
    $stmt->execute();

    // Preusmeravanje na dashboard nakon brisanja
    header('Location: dashboard.view.php');
    exit();
}

// Ako je korisnik tražio izmenu
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    // Preuzimanje podataka korisnika iz baze da bi se izmenili
    $stmt = $pdo->prepare("SELECT * FROM users WHERE ID = :id");
    $stmt->bindParam(':id', $edit_id);
    $stmt->execute();
    $user = $stmt->fetch();
}
if (!isset($pdo)) {
    die("Greška: Konekcija sa bazom nije uspostavljena.");
}

// Prikazivanje liste korisnika
$stmt = $pdo->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->fetchAll();
if (!isset($_SESSION['user_name'])) {
    $_SESSION['user_name'] = 'Nepoznat korisnik'; // Postavi default vrednost ako nije postavljen
}

// Prosleđivanje podataka u prikaz
include('views/dashboard.view.php'); // Prosleđivanje $users, $user_name, $user_id u dashboard.view.php
?>
