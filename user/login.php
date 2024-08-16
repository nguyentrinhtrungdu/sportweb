<?php
session_start();
include_once __DIR__ . '/connectdb.php'; // Bao gồm tệp kết nối cơ sở dữ liệu
include_once __DIR__ . '/user.php'; // Bao gồm lớp User

// Khởi tạo đối tượng User với tham số $pdo
$user = new User($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ POST
    $email = $_POST['email'] ?? '';
    $password = $_POST['login_password'] ?? '';

    $loginSuccess = $user->login($email, $password);

    if ($loginSuccess) {
        $_SESSION['user_name'] = $user->getUsernameByEmail($email);
        $_SESSION['user_id'] = $user->getUserId($email);
        $_SESSION['user_role'] = $user->getUserRole($email);
        $_SESSION['user_art'] = $user->getArtByEmail($email);

        // Điều hướng dựa trên vai trò người dùng
        if ($_SESSION['user_role'] === 'admin') {
            header("Location: ../admin/categorylist.php "); // Đường dẫn đến trang admin
        } else {
            header("Location: /index.php"); // Đường dẫn đến trang chính
        }
        exit();
    } else {
        $txt_erro = "Email hoặc mật khẩu không chính xác.";
    }
}
?>
