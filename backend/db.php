<?php
$host = "localhost";
$dbname = "user_management";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Prikazuje SQL greške
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Podrazumevani način vraćanja podataka
    ]);
} catch (PDOException $e) {
    die(json_encode(["success" => false, "message" => "Database connection failed: " . $e->getMessage()]));
}
?>
