<!-- Header -->
<?php
// Ako je korisnik ulogovan, prikazujemo dugme za logout
if(isset($_SESSION['user_id'])) {
    echo '<a href="logout.php" class="btn btn-danger">Logout</a>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">User Management</a>
    </nav>
