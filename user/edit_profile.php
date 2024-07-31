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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process form submission
    $name = trim($_POST['name']);
    $number = trim($_POST['number']);
    $address = trim($_POST['address']);

    // Validate inputs
    if (empty($name) || empty($number) || empty($address)) {
        $error = "All fields are required.";
    } else {
        // Update user info
        $updateResult = updateUserInfo($pdo, $userId, $name, $userInfo['email'], $number, $address);

        if ($updateResult) {
            $success = "Information updated successfully.";
        } else {
            $error = "An error occurred during update.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa thông tin cá nhân</title>
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/profile.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.5.2-web/css/all.min.css">
</head>
<body>
    <main>
        <?php include ("../header.php"); ?>
        <section class="edit-profile">
            <h1>Chỉnh sửa thông tin cá nhân</h1>

            <?php if (isset($success)): ?>
                <p class="success"><?php echo htmlspecialchars($success); ?></p>
            <?php elseif (isset($error)): ?>
                <p class="error"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <form action="edit_profile.php" method="post">
                <label for="name">Họ và tên:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($userInfo['name']); ?>" required>

                <label for="number">Số điện thoại:</label>
                <input type="text" id="number" name="number" value="<?php echo htmlspecialchars($userInfo['number']); ?>" required>

                <label for="address">Địa chỉ:</label>
                <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($userInfo['address']); ?>" required>

                <button type="submit" class="btn">Cập nhật thông tin</button>
            </form>
        </section>
    </main>
    <?php include ("../footer.php"); ?>
</body>
</html>
