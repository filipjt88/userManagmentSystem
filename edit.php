<?php
require_once 'core/init.php';

if (!isset($_GET['id'])) {
    die('User ID is required');
}

$user_id = $_GET['id'];
$user = getUser($user_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];

    // Validacija podataka
    if (empty($firstname) || empty($lastname) || empty($email)) {
        echo "All fields are required.";
    } elseif (!validateEmail($email)) {
        echo "Invalid email format.";
    } else {
        // Izmena korisnika
        updateUser($user_id, $firstname, $lastname, $email);
        header('Location: users.view.php');
        exit();
    }
}
?>

<?php include 'includes/header.php'; ?>
<div class="container">
    <h2>Edit User</h2>
    <form method="POST">
        <input type="text" name="firstname" class="form-control" value="<?= $user['firstname'] ?>" required>
        <input type="text" name="lastname" class="form-control" value="<?= $user['lastname'] ?>" required>
        <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" required>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
<?php include 'includes/footer.php'; ?>
