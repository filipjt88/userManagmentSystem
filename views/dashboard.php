<?php
session_start();

// Provera da li je korisnik ulogovan
if (!isset($_SESSION['user_id'])) {
    // Ako korisnik nije ulogovan, preusmeri ga na login
    header('Location: login.view.php');
    exit();
}

// Prikazivanje podataka o korisniku
$user_name = $_SESSION['user_name']; // Ime korisnika koje je smešteno u sesiji
$user_id = $_SESSION['user_id']; // ID korisnika

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Učitaj Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Dobrodošli, <?php echo $user_name; ?>!</h1>
        
        <div class="alert alert-success" role="alert">
            Ulogovali ste se kao korisnik sa ID-jem: <?php echo $user_id; ?>
        </div>

        <p>Odavde možete upravljati korisnicima, pregledati podatke, itd.</p>

        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>

    <!-- Bootstrap JS (opcionalno) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="htt
