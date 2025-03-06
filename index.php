<?php
session_start(); // Pokrećemo sesiju

// Provera da li je korisnik ulogovan
if (isset($_SESSION['user_id'])) {
    // Ako je korisnik ulogovan, preusmeravamo ga na dashboard
    header("Location: dashboard.php");
    exit();
} else {
    // Ako nije ulogovan, preusmeravamo ga na login stranicu
    header("Location: login.php");
    exit();
}
?>
