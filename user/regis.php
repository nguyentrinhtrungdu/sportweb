<?php
session_start();
include "connectdb.php";

if (isset($_POST['dangky'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $pass = $_POST['pass'];
    $repass = $_POST['repass'];

    if (!empty($name) && !empty($email) && !empty($address) && !empty($pass) && $pass === $repass) {
        // Kiểm tra xem email có tồn tại không
        $conn = connectbd();
        $sql = "SELECT COUNT(*) AS count FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row['count'] > 0) {
            echo "Email đã được sử dụng, vui lòng sử dụng email khác.";
        } else {
            // Thực hiện câu truy vấn SQL để đăng ký
            $sql = "INSERT INTO users (name, email, address, pass) VALUES (:name, :email, :address, :pass)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':pass', $pass);

            if ($stmt->execute()) {
                $_SESSION['user_id'] = $conn->lastInsertId();
                $_SESSION['user_name'] = $name;
                $_SESSION['user_email'] = $email;
                
                header("Location: /index.php");
                exit();
            } else {
                $errorInfo = $stmt->errorInfo();
                echo "Lỗi: " . $errorInfo[2];
            }
        }
    } else {
        echo "Bạn cần điền đủ thông tin hoặc mật khẩu không khớp";
    }
}
?>
