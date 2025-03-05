<?php
require 'base/db.php';

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["name"], $data["email"], $data["password"])) {
    echo json_encode(["success" => false, "message" => "Sva polja su obavezna!"]);
    exit;
}

$name = $data["name"];
$email = $data["email"];
$password = password_hash($data["password"], PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
    $stmt->execute(["name" => $name, "email" => $email, "password" => $password]);

    echo json_encode(["success" => true, "message" => "Uspešno registrovan!"]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Greška pri registraciji: " . $e->getMessage()]);
}
?>
