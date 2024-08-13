<?php
include_once __DIR__ . '/connectdb.php'; // Bao gồm tệp kết nối cơ sở dữ liệu

if (isset($_GET['email'])) {
    $email = trim($_GET['email']);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => 'Email không hợp lệ.']);
        exit();
    }

    try {
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            echo json_encode(['status' => 'error', 'message' => 'Email đã tồn tại.']);
        } else {
            echo json_encode(['status' => 'success', 'message' => 'Email hợp lệ.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Lỗi cơ sở dữ liệu.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Không có email được gửi.']);
}
?>
