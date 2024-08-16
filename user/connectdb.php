<?php
$dsn = 'mysql:host=localhost;dbname=websport;charset=utf8';
$username = 'root'; // Thay đổi nếu cần
$password = ''; // Thay đổi nếu cần
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    throw new RuntimeException('Không thể kết nối đến cơ sở dữ liệu: ' . $e->getMessage());
}
?>
