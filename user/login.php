<?php
session_start();
include_once __DIR__ . '/user.php'; // Đảm bảo đường dẫn đúng

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ POST
    $email = $_POST['email'] ?? '';
    $password = $_POST['login_password'] ?? '';

    $user = new User();
    $loginSuccess = $user->login($email, $password);

    if ($loginSuccess) {
        $_SESSION['user_name'] = $user->getUsernameByEmail($email);
        $_SESSION['user_id'] = $user->getUserId($email);
        $_SESSION['user_role'] = $user->getUserRole($email);

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
