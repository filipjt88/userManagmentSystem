<?php
session_start(); // Ovdje pozivamo session_start()
// Provera da li je korisnik ulogovan
if (!isset($_SESSION['user_id'])) {
    // Ako korisnik nije ulogovan, preusmeri ga na login
    header('Location: login.view.php');
    exit();
}



// Prikazivanje podataka o korisniku
$user_name = $_SESSION['user_name']; // Ime korisnika koje je smešteno u sesiji
$user_id = $_SESSION['user_id']; // ID korisnika

// Ako je korisnik tražio brisanje
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Proveravamo da li korisnik može da obriše (ako je admin ili neko s pravima)
    $stmt = $pdo->prepare("DELETE FROM users WHERE ID = :id");
    $stmt->bindParam(':id', $delete_id);
    $stmt->execute();

    // Preusmeravanje na dashboard nakon brisanja
    header('Location: dashboard.php');
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

// Prikazivanje liste korisnika
$stmt = $pdo->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->fetchAll();

// Prosleđivanje podataka u prikaz
include('views/dashboard.view.php'); // Prosleđivanje $users, $user_name, $user_id u dashboard.view.php
?>
