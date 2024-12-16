<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ./auth/login.php");
    exit();
}

echo "<h1>Welcome, " . htmlspecialchars($_SESSION['name']) . "!</h1>";
echo "<p><a href='./auth/logout.php'>Logout</a></p>";
?>
