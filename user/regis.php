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
   

        // Thực hiện câu truy vấn SQL
        $sql = "INSERT INTO tbl_user (name, email, address, pass) VALUES (:name, :email, :address, :pass)";
        
        // Sử dụng PDO để chạy câu truy vấn này
        $conn = connectbd();
        if ($conn) {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':pass', $pass);

            if ($stmt->execute()) {
                // Lưu thông tin người dùng vào session
                $_SESSION['user_id'] = $conn->lastInsertId();
                $_SESSION['user_name'] = $name;
                $_SESSION['user_email'] = $email;
                
                // Chuyển hướng người dùng đến trang chính (hoặc trang bạn muốn)    
                header("Location: /index.php"); // Thay đổi đường dẫn phù hợp
                exit();
            } else {
                $errorInfo = $stmt->errorInfo();
                echo "Lỗi: " . $errorInfo[2];
            }
        } else {
            echo "Kết nối cơ sở dữ liệu thất bại";
        }
    } else {
        echo "Bạn cần điền đủ thông tin hoặc mật khẩu không khớp";
    }
}
?>
