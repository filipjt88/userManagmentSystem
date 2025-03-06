<?php
require_once 'core/init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validacija podataka
    if (empty($firstname) || empty($lastname) || empty($email) || empty($password)) {
        echo "All fields are required.";
    } elseif (!validateEmail($email)) {
        echo "Invalid email format.";
    } elseif (!validatePassword($password)) {
        echo "Password must be at least 6 characters long.";
    } else {
        // Kreiranje korisnika
        createUser($firstname, $lastname, $email, $password);
        header('Location: views/login.view.php');
        exit();
    }
}
?>
