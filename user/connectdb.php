<?php
$host = 'localhost'; // Thay đổi nếu cần
$dbname = 'websport';
$user = 'root'; // Thay đổi với tên người dùng DB của bạn
$pass = ''; // Thay đổi với mật khẩu DB của bạn

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log("Connection failed: " . $e->getMessage());
    die("Connection failed: " . $e->getMessage());
}
?>
