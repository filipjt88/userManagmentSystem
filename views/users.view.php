<?php include 'includes/header.php'; ?>
<div class="container">
    <h2>Users List</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $users = getUsers();
            foreach ($users as $user) {
                echo "<tr>
                    <td>{$user['id']}</td>
                    <td>{$user['firstname']}</td>
                    <td>{$user['lastname']}</td>
                    <td>{$user['email']}</td>
                    <td>
                        <a href='edit.php?id={$user['id']}' class='btn btn-warning'>Edit</a>
                        <a href='delete.php?id={$user['id']}' class='btn btn-danger'>Delete</a>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<?php include 'includes/footer.php'; ?>
