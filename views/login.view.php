<?php
session_start();
if(isset($_SESSION['user_id'])) {
    header('Location: dashboard.php'); // ili neka druga stranica
    exit();
}
?>

<?php include '../includes/header.php'; ?>
<div class="container">
    <h2>Login</h2>
    <form action="dashboard.view.php" method="POST">
        <input type="email" name="email" class="form-control" placeholder="Email" required>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
<?php include '../includes/footer.php'; ?>
