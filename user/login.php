<?php
session_start();
include_once __DIR__ . '/user.php'; // Đảm bảo đường dẫn đúng

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ POST
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $txt_erro = "Vui lòng nhập cả email và mật khẩu.";
    } else {
        $user = new User();
        $loginSuccess = $user->login($email, $password);

        if ($loginSuccess) {
            $_SESSION['user_name'] = $user->getUsernameByEmail($email);
            $_SESSION['user_id'] = $user->getUserId($email);
            $_SESSION['user_role'] = $user->getUserRole($email);
            $_SESSION['user_art'] = $user->getArtByEmail($email);

            header("Location: /index.php");
            exit();
        } else {
            $txt_erro = "Email hoặc mật khẩu không chính xác.";
        }
    }

    // Hiển thị thông báo lỗi nếu có
    if (isset($txt_erro)) {
        echo $txt_erro;
    }
}
?>
