<?php
require_once 'connection.php';

function createUser($firstname, $lastname, $email, $password) {
    global $pdo;

    // Provera da li je email već u bazi
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $existingUser = $stmt->fetch();

    if ($existingUser) {
        // Ako postoji korisnik sa istim emailom, vrati grešku
        echo "Korisnik sa ovim email-om već postoji!";
        return;
    }

    // Validacija unosa
    if (empty($firstname) || empty($lastname) || empty($email) || empty($password)) {
        echo "Svi podaci moraju biti popunjeni!";
        return;
    }

    // Validacija email-a
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Neispravan format email-a!";
        return;
    }

    try {
        // Unos novog korisnika u bazu
        $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
        $stmt->execute([$firstname, $lastname, $email, password_hash($password, PASSWORD_DEFAULT)]);
        echo "Korisnik je uspešno kreiran!";
    } catch (PDOException $e) {
        // Obrada greške u slučaju neuspeha
        echo "Greška pri kreiranju korisnika: " . $e->getMessage();
    }
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
