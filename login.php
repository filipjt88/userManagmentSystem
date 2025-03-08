<?php
session_start(); // Pokrećemo sesiju
require_once 'core/connection.php'; // Uveži konekciju sa bazom

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Provera u bazi podataka (koristi PDO)
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Ako su podaci tačni, postavljamo sesiju
        $_SESSION['user_id'] = $user['ID'];  // Proveri da li je polje u bazi 'ID' ili 'id'
        $_SESSION['user_name'] = $user['firstname']; 

        // Preusmeravanje na dashboard
        header('Location: views/dashboard.view.php');
        exit();
    } else {
        echo "Pogrešan email ili lozinka!";
    }
}
?>
