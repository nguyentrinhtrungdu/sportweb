<?php
session_start();
include_once __DIR__ . "/user/user_class.php";
include_once __DIR__ . "/admin/class/order_class.php"; // Ensure this path is correct

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['product_price'] * $item['quantity'];
        }

        // Retrieve user information
        $userClass = new User();
        $user_id = $_SESSION['user_id']; // Ensure this matches the session key where user ID is stored

        if (isset($user_id)) {
            $user = $userClass->get_user_by_id($user_id);

            if ($user) {
                $user_name = $user['name'];
                $address = htmlspecialchars($_POST['address']); // Sanitize user input

                // Create an order
                $orderClass = new Order();

                try {
                    $order_id = $orderClass->create_order($user_id, $user_name, $address, $total);

                    // Insert order items
                    foreach ($_SESSION['cart'] as $item) {
                        $orderClass->add_order_item($order_id, $item['product_id'], $item['product_name'], $item['product_img'], $item['product_price'], $item['quantity'], $item['descr']);
                    }

                    // Clear cart
                    unset($_SESSION['cart']);

                    // Redirect to a thank you page or order summary page
                    header("Location: thank_you.php?order_id=" . $order_id);
                    exit();
                } catch (Exception $e) {
                    echo "An error occurred while processing your order: " . $e->getMessage();
                }
            } else {
                echo "User information not found.";
                exit();
            }
        }
    } else {
        echo "Your cart is empty.";
    }
}
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
    <?php include "header.php"; ?>

    <!-- Cart Container -->
    <div class="cart-container">
        <h2>GIỎ HÀNG CỦA BẠN</h2>

        <?php
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])):
            $total = 0;
            ?>
            <form method="post" action="">
                <?php foreach ($_SESSION['cart'] as $item):
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

                <p class="total-amount">Tổng tiền: <?php echo number_format($total, 0, ',', '.'); ?>đ</p>

                <div class="order-notes">
                    <label for="order-notes">GHI CHÚ ĐƠN HÀNG</label>
                    <textarea id="order-notes" name="order_notes"></textarea>
                </div>

                <div class="order-address">
                    <label for="address">Địa chỉ giao hàng</label>
                    <input type="text" id="address" name="address" required>
                </div>

                <div class="btn-container">
                    <button type="submit" class="btn-checkout">Thanh toán</button>
                </div>
            </form>
        <?php else: ?>
            <p>Giỏ hàng của bạn trống.</p>
        <?php endif; ?>
    </div>
</body>
</html>
