<?php
session_start(); // Pokrećemo sesiju
$_SESSION['user_id'] = $user['id']; // Čuva ID korisnika u sesiji
$_SESSION['user_name'] = $user['firstname']; // Čuva ime korisnika
header("Location: dashboard.php");
exit;

// Provera podataka za logovanje
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Provera u bazi podataka (koristi PDO)
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Ako su podaci tačni, postavljamo sesiju
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['firstname']; // ili puno ime
        header('Location: dashboard.view.php');
        exit();
    } else {
        echo "Pogrešan email ili lozinka!";
    }
}
?>
