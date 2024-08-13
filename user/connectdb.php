<?php
$host = 'localhost'; // Change this if necessary
$dbname = 'websport';
$user = 'root'; // Replace with your DB username
$pass = ''; // Replace with your DB password
try {
    $pdo = new PDO('mysql:host=localhost;dbname=websport', $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log("Connection failed: " . $e->getMessage());
    die("Connection failed: " . $e->getMessage());
}
?>
