<?php
session_start();
include_once __DIR__ . "/user.php"; // Đường dẫn đến lớp xử lý đăng ký

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    // Xử lý đăng ký (thay đổi theo cách bạn xử lý đăng ký)
    $user = new User(); // Khởi tạo lớp người dùng
    $registerSuccess = $user->register($name, $password, $email,$address,$num);

    if ($registerSuccess) {
        $_SESSION['user_name'] = $name;
        $_SESSION['user_id'] = $user->getUserId($email); // Ví dụ, lấy user_id từ email
        $_SESSION['user_role'] = 'user'; // Tự động gán vai trò 'user'

        header("Location: /index.php"); // Chuyển hướng về trang chính hoặc trang hiện tại
        exit();
    } else {
        $error = "Đăng ký không thành công. Vui lòng thử lại.";
    }
}
?>
