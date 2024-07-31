<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

include 'connectdb.php'; // Include the database connection
include 'user.php'; // Include user-related functions

$pdo = connectbd(); // Initialize the PDO instance

if ($pdo === null) {
    echo "Database connection failed.";
    exit();
}

$userId = $_SESSION['user_id'];
$userInfo = getUserInfoById($pdo, $userId); // Fetch user info

if (!$userInfo) {
    echo "User information not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Cá Nhân</title>
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/profile.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.5.2-web/css/all.min.css">
</head>
<body>
    <main>
        <?php include ("../header.php"); ?>
        <div class="container">
        <section class="profile">
            <h1>Thông Tin Cá Nhân</h1>
            <div class="profile-info">
                <p><strong>Họ và tên:</strong> <?php echo htmlspecialchars($userInfo['name']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($userInfo['email']); ?></p>
                <p><strong>Số điện thoại:</strong> <?php echo htmlspecialchars($userInfo['number']); ?></p>
                <p><strong>Địa chỉ:</strong> <?php echo htmlspecialchars($userInfo['address']); ?></p>
                <!-- Add other information as needed -->
            </div>
            <a href="edit_profile.php" class="btn">Chỉnh sửa thông tin</a>
        </section>
        </div>
    </main>
    <?php include ("../footer.php"); ?>
</body>
</html>
