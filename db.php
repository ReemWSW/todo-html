<?php
$host = 'localhost';    // Change if your host differs
$dbname = 'todo_app';   // Your database name
$username = 'root';     // Your username
$password = '';         // Your password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit;
}
?>
