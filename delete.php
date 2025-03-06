<?php
require_once 'core/init.php';

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    deleteUser($user_id);
    header('Location: users.view.php');
    exit();
} else {
    die('User ID is required');
}
?>
