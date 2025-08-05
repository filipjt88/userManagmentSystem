<!-- Dashboard -->
<?php
require_once 'core/connection.php'; 
session_start();

//Provera da li je konekcija sa bazom uspostavljena
if (!isset($pdo)) {
    die("Greška: Konekcija sa bazom nije uspostavljena.");
}

// Provera da li je korisnik ulogovan
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Preusmeravanje na login stranicu
    exit();
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

    // Ponovo učitaj dashboard da se osveži lista korisnika
    header('Location: dashboard.php');
    exit();
}

// Ako je korisnik tražio izmenu
$user = null;
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];

    // Preuzimanje podataka korisnika iz baze da bi se izmenili
    $stmt = $pdo->prepare("SELECT * FROM users WHERE ID = :id");
    $stmt->bindParam(':id', $edit_id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Prikazivanje liste korisnika
$stmt = $pdo->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Provera da li je ime korisnika postavljeno u sesiji
if (!isset($_SESSION['user_name'])) {
    $_SESSION['user_name'] = 'Nepoznat korisnik'; // Postavi default vrednost ako nije postavljen
}

include('views/dashboard.view.php'); // Prosleđivanje $users i $user
?>
