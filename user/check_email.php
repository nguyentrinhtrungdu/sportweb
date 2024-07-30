<?php
include "connectdb.php";
include "user.php";

header('Content-Type: application/json');

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $exists = checkEmailExists($email); // Giả sử bạn có một hàm checkEmailExists để kiểm tra email
    
    echo json_encode(['exists' => $exists]);
}

function checkEmailExists($email) {
    // Thực hiện truy vấn cơ sở dữ liệu để kiểm tra xem email có tồn tại không
    // Trả về true nếu tồn tại, false nếu không tồn tại
    // Ví dụ:
    $query = "SELECT COUNT(*) AS count FROM tbl_user WHERE email = ?";
    $stmt = $GLOBALS['conn']->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    return $row['count'] > 0;
}
?>
