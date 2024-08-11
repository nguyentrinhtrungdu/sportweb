<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán</title>

    <link rel="stylesheet" href="./assets/css/thanhtoan.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-6.5.2-web/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <?php 
    include "header.php";
    ?>

    <!-- Cart Container -->
    <div class="cart-container">
        <h2>GIỎ HÀNG CỦA BẠN</h2>

        <?php
        // Kiểm tra xem giỏ hàng có sản phẩm hay không
        if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])):
            $total = 0;
            foreach($_SESSION['cart'] as $item):
                $total += $item['product_price'] * $item['quantity'];
        ?>
            <div class="cart-item">
                <div class="item-image">
                    <img src="<?php echo 'admin/uploads/' . htmlspecialchars($item['product_img'], ENT_QUOTES, 'UTF-8'); ?>" alt="Product Image">
                </div>
                <div class="item-details">
                    <p class="product-name"><?php echo htmlspecialchars($item['product_name'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <p class="product-quantity">Số lượng: <?php echo (int)$item['quantity']; ?></p>
                </div>
                <div class="item-actions">
                    <span class="item-price"><?php echo number_format($item['product_price'], 0, ',', '.'); ?>đ</span>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- Hiển thị tổng số tiền -->
        <p class="total-amount">Tổng tiền: <?php echo number_format($total, 0, ',', '.'); ?>đ</p>

        <!-- Ghi chú đơn hàng -->
        <div class="order-notes">
            <label for="order-notes">GHI CHÚ ĐƠN HÀNG</label>
            <textarea id="order-notes" name="order_notes"></textarea>
        </div>

        <!-- Nút thanh toán -->
        <div class="btn-container">
            <button class="btn-checkout" id="checkoutBtn">Thanh toán</button>
        </div>

        <?php else: ?>
            <p>Giỏ hàng của bạn trống.</p>
        <?php endif; ?>
    </div>

   

    
    
</body>
</html>
