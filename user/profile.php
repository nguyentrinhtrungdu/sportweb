<?php
session_start();
include 'connectdb.php';
include 'user.php'; // Bao gồm tệp User.php chứa lớp User


// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];
$userObj = new User();

// Lấy thông tin người dùng dựa trên user_id
$user = $userObj->get_user_by_id($userId);

if (!$user) {
    echo "Không thể lấy thông tin người dùng.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/profile.css">
    <title>Thông tin người dùng</title>
</head>
<body>
    <h1>Thông tin người dùng</h1>

    <?php if ($user): ?>
        <p>Ảnh đại diện:</p>
        <img src="../assets/img/avatar_defaut/<?php echo htmlspecialchars($user['art'] ?: 'default_avatar.jpg'); ?>" alt="User Avatar" >

        <p>Tên: <?php echo htmlspecialchars($user['name']); ?></p>
        <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
        <p>Số điện thoại: <?php echo htmlspecialchars($user['num']); ?></p>
        <p>Địa chỉ: <?php echo htmlspecialchars($user['address']); ?></p>
    <?php else: ?>
        <p>Không có thông tin người dùng để hiển thị.</p>
    <?php endif; ?>

    <a href="../edit_profile.php">Chỉnh sửa</a>
</body>
</html>
