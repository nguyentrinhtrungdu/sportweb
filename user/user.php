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
?>