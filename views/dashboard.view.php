<?php
session_start(); // Ovdje pokrećemo sesiju

// Proveri da li su podaci u sesiji postavljeni pre nego što ih koristiš
if (!isset($_SESSION['user_name'])) {
    echo "Greška: Niste ulogovani!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Učitaj Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Dobrodošli, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
        
        <div class="alert alert-success" role="alert">
            Ulogovali ste se kao korisnik sa ID-jem: <?php echo $_SESSION['user_id']; ?>
        </div>

        <h2>Lista korisnika</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>Email</th>
                    <th>Akcija</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (isset($users) && !empty($users)) {
                    foreach ($users as $user) { ?>
                        <tr>
                            <td><?php echo $user['ID']; ?></td>
                            <td><?php echo $user['firstname']; ?></td>
                            <td><?php echo $user['lastname']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td>
                                <a href="dashboard.php?edit_id=<?php echo $user['ID']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="dashboard.php?delete_id=<?php echo $user['ID']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php }
                } else {
                    echo "<tr><td colspan='5'>Nema korisnika!</td></tr>";
                } ?>
            </tbody>
        </table>

        <?php if (isset($edit_id)) { ?>
            <h2>Izmeni korisnika</h2>
            <form action="dashboard.php" method="POST">
                <div class="form-group">
                    <label for="firstname">Ime</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $user['firstname']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="lastname">Prezime</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $user['lastname']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Spasi promene</button>
            </form>
        <?php } ?>

        <a href="logout.php" class="btn btn-danger mt-4">Logout</a>
    </div>

    <!-- Bootstrap JS (opcionalno) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
