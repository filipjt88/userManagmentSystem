<?php
require_once 'core/init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validacija podataka
    if (empty($email) || empty($password)) {
        echo "All fields are required.";
    } else {
        // Provera da li korisnik postoji u bazi
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Prijavljivanje korisnika
            $_SESSION['user_id'] = $user['ID'];
            $_SESSION['user_email'] = $user['email'];
            header('Location:dashboard.php');
            exit();
        } else {
            echo "Invalid email or password.";
        }
    }
}
?>
