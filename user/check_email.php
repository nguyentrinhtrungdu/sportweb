<?php
include_once __DIR__ . '/connectdb.php'; // Bao gồm tệp kết nối cơ sở dữ liệu
include_once __DIR__ . '/user.php'; // Bao gồm tệp lớp User

// Tạo đối tượng PDO
$pdo = new PDO('mysql:host=localhost;dbname=websport;charset=utf8', 'root', ''); // Thay đổi theo cấu hình của bạn
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$user = new User($pdo);

if (isset($_POST['email'])) {
    $email = trim($_POST['email']); // Loại bỏ khoảng trắng không cần thiết

    // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu chưa
    $stmt = $pdo->prepare("SELECT email FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $existingEmail = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingEmail) {
        echo json_encode(['status' => 'exists', 'message' => 'Email đã tồn tại']);
    } else {
        echo json_encode(['status' => 'valid', 'message' => 'Email hợp lệ']);
    }
}
?>
