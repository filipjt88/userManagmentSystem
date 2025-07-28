<!-- API -->
<?php
require_once '../core/init.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $user = getUser($_GET['id']);
            echo json_encode($user);
        } else {
            $users = getUsers();
            echo json_encode($users);
        }
        break;

    case 'POST':
        // Kreiranje korisnika
        $data = json_decode(file_get_contents('php://input'), true);
        createUser($data['firstname'], $data['lastname'], $data['email'], $data['password']);
        echo json_encode(["message" => "User created successfully"]);
        break;

    case 'PUT':
        // Izmena korisnika
        $data = json_decode(file_get_contents('php://input'), true);
        updateUser($data['id'], $data['firstname'], $data['lastname'], $data['email']);
        echo json_encode(["message" => "User updated successfully"]);
        break;

    case 'DELETE':
        // Brisanje korisnika
        $data = json_decode(file_get_contents('php://input'), true);
        deleteUser($data['id']);
        echo json_encode(["message" => "User deleted successfully"]);
        break;
}
?>
