<?php
session_start();
include_once __DIR__ . "/connectdb.php"; // Bao gồm tệp kết nối cơ sở dữ liệu
include_once __DIR__ . "/user.php"; // Bao gồm tệp lớp User

// Tạo đối tượng PDO
$pdo = new PDO('mysql:host=localhost;dbname=websport;charset=utf8', 'root', ''); // Thay đổi theo cấu hình của bạn
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$user = new User($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $num = $_POST['num'];

    // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu chưa
    $stmt = $pdo->prepare("SELECT email FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $existingEmail = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingEmail) {
        // Lưu thông báo lỗi vào session và chuyển hướng về trang đăng ký với thông báo lỗi
        $_SESSION['register_error'] = "Email đã tồn tại.";
        header("Location: /modal.php"); // Thay đổi đường dẫn đến trang đăng ký của bạn
        exit();
    } else {
        // Xử lý đăng ký
        $registerSuccess = $user->register($name, $password, $email, $address, $num);

        if ($registerSuccess) {
            $_SESSION['user_name'] = $name;
            $_SESSION['user_id'] = $user->getUserId($email); // Lấy user_id từ email
            $_SESSION['user_role'] = 'user'; // Tự động gán vai trò 'user'

            header("Location: /index.php"); // Chuyển hướng về trang chính hoặc trang hiện tại
            exit();
        } else {
            $_SESSION['register_error'] = "Đăng ký không thành công. Vui lòng thử lại.";
            header("Location: /modal.php"); // Thay đổi đường dẫn đến trang đăng ký của bạn
            exit();
        }
    }
}
?>
