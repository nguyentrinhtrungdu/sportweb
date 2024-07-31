<?php
include "connectdb.php";
header('Content-Type: application/json');

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $exists = checkEmailExists($email); 
    
    echo json_encode([
        'exists' => $exists,
        'message' => $exists ? 'Email đã được sử dụng, vui lòng sử dụng email khác' : ''
    ]);
}

function checkEmailExists($email) {
    $conn = connectbd();
    $query = "SELECT COUNT(*) AS count FROM tbl_user WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(1, $email);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['count'] > 0;
}
?>
