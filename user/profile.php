<?php
include 'connectdb.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];
$conn = connectbd();
if ($conn) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->bindParam(':id', $userId);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<h1>Thông tin người dùng</h1>
<p>Tên: <?php echo htmlspecialchars($user['name']); ?></p>
<p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
<p>Số điện thoại: <?php echo htmlspecialchars($user['number']); ?></p>
<p>Địa chỉ: <?php echo htmlspecialchars($user['address']); ?></p>
<p>Vai trò: <?php echo htmlspecialchars($user['role']); ?></p>
<a href="logout.php">Đăng xuất</a>
