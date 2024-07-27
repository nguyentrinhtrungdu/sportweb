<?php
function checkuser($user,$pass){
    $conn=connectbd();
    $stmt = $conn->prepare("SELECT * FROM tbl_user WHERE user='".$user."' AND pass = '".$pass."'");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq=$stmt->fetchAll();
    if(count($kq)>0) return $kq[0]['role'];
    else return null;


}
function getuserinfo($user,$pass){
    $conn=connectbd();
    $stmt = $conn->prepare("SELECT * FROM tbl_user WHERE user='".$user."' AND pass = '".$pass."'");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq=$stmt->fetchAll();
    return $kq;


}
?>