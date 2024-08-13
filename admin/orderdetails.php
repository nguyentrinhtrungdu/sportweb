<?php
include "header.php";
include "slider.php";
include "class/order_class.php"; // Include class xử lý đơn hàng

$order = new Order(); // Khởi tạo đối tượng Order

// Lấy ID đơn hàng từ tham số GET
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

// Kiểm tra ID đơn hàng hợp lệ
if ($order_id <= 0) {
    die("ID đơn hàng không hợp lệ.");
}

// Lấy thông tin đơn hàng
$order_details = $order->get_order_details($order_id);

// Kiểm tra nếu đơn hàng tồn tại
if (!$order_details) {
    die("Đơn hàng không tồn tại.");
}

// Lấy thông tin các sản phẩm trong đơn hàng
$order_items = $order->get_order_items($order_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   
<h1>Chi tiết đơn hàng</h1>   
    <section class="admin-content">
        <div class="admin-content-right">
            <div class="admin-content-right-order_details">   
                       
                <table>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Hình ảnh</th>
                        <th>Số lượng</th>
                    </tr>
                    <?php
                    if ($order_items && $order_items->num_rows > 0) {
                        while ($item = $order_items->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($item['product_name']) . "</td>";
                            echo "<td>" . number_format($item['product_price'], 0, ',', '.') . "đ</td>";
                            echo "<td><img src='./uploads/" . htmlspecialchars($item['product_img']) . "' alt='" . htmlspecialchars($item['product_name']) . "' width='100'></td>";
                            echo "<td>" . htmlspecialchars($item['quantity']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Không có sản phẩm nào trong đơn hàng</td></tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </section>
</body>
</html>
