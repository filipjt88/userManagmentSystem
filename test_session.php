<?php
session_start();
$_SESSION['user_id'] = 1;
$_SESSION['user_name'] = 'Filip';

echo "Sesija je postavljena!<br>";
echo "User ID: " . $_SESSION['user_id'] . "<br>";
echo "User Name: " . $_SESSION['user_name'] . "<br>";
?>
