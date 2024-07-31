<?php
function checkuser($email,$pass){
    $conn=connectbd();
    $stmt = $conn->prepare("SELECT * FROM tbl_user WHERE email='".$email."' AND pass = '".$pass."'");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq=$stmt->fetchAll();
    if(count($kq)>0) return $kq[0]['role'];
    else return null;


}
function getuserinfo($email,$pass){
    $conn=connectbd();
    $stmt = $conn->prepare("SELECT * FROM tbl_user WHERE email='".$email."' AND pass = '".$pass."'");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq=$stmt->fetchAll();
    return $kq;


}

// Update your functions to receive $pdo as an argument

function updateUserInfo($pdo, $userId, $name, $email, $number, $address) {
    try {
        $sql = "UPDATE tbl_user SET name = :name, email = :email, number = :number, address = :address WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':number', $number);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':id', $userId);
        return $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

function getUserInfoById($pdo, $userId) {
    try {
        $stmt = $pdo->prepare("SELECT name, email, number, address FROM tbl_user WHERE id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }
}
?>


