<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán Thành Công</title>

    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/paysuccess.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-6.5.2-web/css/all.min.css">
</head>
<body>
    
    <!-- Header -->
    <?php 
    session_start();
    include "header.php"; ?>

    <!-- Success Container -->
    <div class="success-container">
        <h2>Đơn Hàng Của Bạn Đã Được Xác Nhận!</h2>
        <p>Cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi. Đơn hàng của bạn đã được xác nhận và chúng tôi sẽ giao hàng trong thời gian sớm nhất.</p>

        <div class="btn-container">
            <a href="allproduct.php" class="btn-continue-shopping">Tiếp Tục Mua Hàng</a>
        </div>
    </div>
    
</body>
</html>
