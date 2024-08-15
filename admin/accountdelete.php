<?php
include_once __DIR__ . '/../user/user.php';
$user = new User;
$user_id = $_GET['user_id'];
$delete_account = $user->delete_account($user_id);
?>
