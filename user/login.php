<?php
session_start();
include_once __DIR__ . '/connectdb.php';
include_once __DIR__ . '/user.php';

$user = new User($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['login_password'] ?? '';

    $loginSuccess = $user->login($email, $password);

    if ($loginSuccess) {
        $_SESSION['user_name'] = $user->getUsernameByEmail($email);
        $_SESSION['user_id'] = $user->getUserId($email);
        $_SESSION['user_role'] = $user->getUserRole($email);
        $_SESSION['user_art'] = $user->getArtByEmail($email);

        if ($_SESSION['user_role'] === 'admin') {
            header("Location: ../admin/categorylist.php");
        } else {
            header("Location: /index.php");
        }
        exit();
    } else {
        $_SESSION['login_error'] = 'Sai email hoặc mật khẩu. Vui lòng thử lại.';
        header("Location: /modal.php");
        exit();
    }
}
?>
