<?php
session_start();
include __DIR__ . '/user/user.php'; // Bao gồm tệp kết nối cơ sở dữ liệu
include __DIR__ . '/admin/class/order_class.php'; // Bao gồm lớp Order

// Tạo đối tượng Order và User
$pdo = new PDO('mysql:host=localhost;dbname=websport', 'root', '');
$orderClass = new Order($pdo);

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['user_id'])) {
    header("Location: modal.php"); // Redirect đến trang đăng nhập nếu chưa đăng nhập
    exit();
}

// Lấy đơn hàng của người dùng
$user_id = $_SESSION['user_id'];
$orders = $orderClass->get_orders_by_user_id($user_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn hàng của tôi</title>
    <link rel="stylesheet" href="./assets/css/myorder.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-6.5.2-web/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <?php include "header.php"; ?>

    <!-- Order Container -->
    <div class="order-container">
        <h2>Đơn hàng của tôi</h2>

        <?php if ($orders): ?>
            <?php foreach ($orders as $order): ?>
                <div class="order-item">
                    <div class="thongtin-container">
                    <h3>Đơn hàng #<?php echo htmlspecialchars($order['order_id']); ?></h3>
                    <p><strong>Địa chỉ:</strong> <?php echo htmlspecialchars($order['address']); ?></p>
                    <p><strong>Tổng tiền:</strong> <?php echo number_format($order['total'], 0, ',', '.'); ?>đ</p>
                    <p><strong>Ngày đặt:</strong> <?php echo htmlspecialchars(date('d/m/Y', strtotime($order['created_at']))); ?></p>
                    
                    <?php
                    // Tính ngày giao hàng (Ngày đặt + 2 ngày)
                    $created_at = new DateTime($order['created_at']);
                    $delivery_date = $created_at->modify('+2 days')->format('d/m/Y');
                    ?>
                    <p><strong>Ngày giao hàng dự kiến:</strong> <?php echo htmlspecialchars($delivery_date); ?></p>

                    <p><strong>Trạng thái:</strong> <?php echo htmlspecialchars($order['status']); ?></p>
                    </div>
                    <!-- Hiển thị sản phẩm trong đơn hàng -->
                    <?php
                    $orderItems = $orderClass->get_order_items($order['order_id']);
                    if ($orderItems && $orderItems->num_rows > 0): ?>
                        <div class="order-items">
                            <?php while ($item = $orderItems->fetch_assoc()): ?>
                                <div class="order-item-detail">
                                    <img src="admin/uploads/<?php echo htmlspecialchars($item['product_img'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($item['product_name']); ?>" class="order-item-img">
                                    <p class="order-item-name"><?php echo htmlspecialchars($item['product_name']); ?></p>
                                    <p class="order-item-price"><?php echo number_format($item['product_price'], 0, ',', '.'); ?>đ</p>
                                    <p class="order-item-quantity">Số lượng: <?php echo (int)$item['quantity']; ?></p>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php else: ?>
                        <p>Không có sản phẩm trong đơn hàng này.</p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Hiện tại bạn không có đơn hàng nào.</p>
        <?php endif; ?>
    </div>
</body>
</html>
