<?php
require_once 'connection.php';

header('Content-Type: application/json');
// We are checking the data to see if it has been sent
if($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Checks if all fields are filled
    if(empty($name) || empty($email) || empty($password)) {
        echo json_encode(["success" => false, "message" => "All fields are required!"]);
        exit;
    }
    // Checking if the email already exists in the database
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if($stmt->rowCount() > 0) {
        echo json_encode(["success" => false, "message" => "Email already exists!"]);
        exit;
    }

    // Password hashing for security
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

    // Adding users to the database
    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?,?,?)");
    $success = $stmt->execute([$name, $email, $hashPassword]);

    if($success) {
        echo json_encode(["sucess" => true, "message" => "Successfully registered!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error during registration!"]);
    }
} else {
    json_encode(["success" => false, "message" => "Invalid request!"]);
}
?>