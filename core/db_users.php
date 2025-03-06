<?php
require_once 'connection.php';

function createUser($firstname, $lastname, $email, $password) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
    $stmt->execute([$firstname, $lastname, $email, password_hash($password, PASSWORD_DEFAULT)]);
}

function getUser($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE ID = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getUsers() {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function updateUser($id, $firstname, $lastname, $email) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE users SET firstname = ?, lastname = ?, email = ? WHERE ID = ?");
    $stmt->execute([$firstname, $lastname, $email, $id]);
}

function deleteUser($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM users WHERE ID = ?");
    $stmt->execute([$id]);
}
?>
