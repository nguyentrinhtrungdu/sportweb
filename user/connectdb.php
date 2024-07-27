<?php
function connectbd() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "user"; // Tên database của bạn

    try {
        // Tạo kết nối PDO
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
        
        // Thiết lập chế độ lỗi của PDO
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $conn; // Trả về đối tượng PDO
    } catch (PDOException $e) {
        // Hiển thị thông báo lỗi nếu kết nối thất bại
        echo "Kết nối thất bại: " . $e->getMessage();
        return null; // Trả về null nếu kết nối thất bại
    }
}
?>
