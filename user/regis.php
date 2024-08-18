<?php
session_start();
include_once __DIR__ . "/connectdb.php"; 
include_once __DIR__ . "/user.php"; 

$pdo = new PDO('mysql:host=localhost;dbname=websport;charset=utf8', 'root', ''); 
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$user = new User($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $num = $_POST['num'];

    // Kiểm tra email đã tồn tại
    $stmt = $pdo->prepare("SELECT email FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $existingEmail = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingEmail) {
        $_SESSION['register_error'] = "Email đã tồn tại.";
        header("Location: /modal.php?form=register");
        exit();
    } else {
        // Đăng ký tài khoản mới
        $registerSuccess = $user->register($name, $password, $email, $address, $num);

        if ($registerSuccess) {
            $_SESSION['user_name'] = $name;
            $_SESSION['user_id'] = $user->getUserId($email);
            $_SESSION['user_role'] = 'user';

            header("Location: /index.php");
            exit();
        } else {
            $_SESSION['register_error'] = "Đăng ký không thành công. Vui lòng thử lại.";
            header("Location: /modal.php?form=register");
            exit();
        }
    }
}
?>
