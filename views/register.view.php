<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['user_id'])) {
    header('Location: dashboard.php'); // ili neka druga stranica
    exit();
}
?>

<?php include '../includes/header.php'; ?>
<div class="container">
    <h2>Register</h2>
    <form action="../register.php" method="POST">
        <input type="text" name="firstname" class="form-control" placeholder="First Name" required><br>
        <input type="text" name="lastname" class="form-control" placeholder="Last Name" required><br>
        <input type="email" name="email" class="form-control" placeholder="Email" required><br>
        <input type="password" name="password" class="form-control" placeholder="Password" required><br>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
<?php include '../includes/footer.php'; ?>
