<?php
include "header.php";
include "slider.php";
include "class/order_class.php"; // Include class xử lý đơn hàng

$order = new Order(); // Khởi tạo đối tượng Order

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'];
    $status = $_POST['status']; // Trạng thái được chọn từ form

    // Cập nhật trạng thái đơn hàng
    $update_status = $order->update_order_status($order_id, $status);

    if ($update_status) {
        // Nếu cập nhật thành công, chuyển hướng đến danh sách đơn hàng
        header("Location: orderlist.php");
        exit();
    } else {
        echo "Cập nhật trạng thái không thành công.";
    }
}

// Lấy thông tin đơn hàng để hiển thị
$order_id = $_GET['order_id'];
$order_details = $order->get_order_details($order_id);

// Chuyển trạng thái từ cơ sở dữ liệu về tiếng Việt
$status_map = [
    'pending' => 'Chờ xác nhận',
    'confirmed' => 'Đã xác nhận',
    'shipped' => 'Đã vận chuyển',
    'delivered' => 'Đã giao'
];
$current_status = $status_map[$order_details['status']] ?? 'Chờ xác nhận';
?>

<div class="admin-content-right">
    <div class="admin-content-right-order_update">
        <h1>Cập nhật trạng thái đơn hàng</h1>
        <form action="" method="POST">
            <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
            <select name="status">
                <option value="Chờ xác nhận" <?php if ($current_status == 'Chờ xác nhận') echo 'selected'; ?>>Chờ xác nhận</option>
                <option value="Đã xác nhận" <?php if ($current_status == 'Đã xác nhận') echo 'selected'; ?>>Đã xác nhận</option>
                <option value="Đã vận chuyển" <?php if ($current_status == 'Đã vận chuyển') echo 'selected'; ?>>Đã vận chuyển</option>
                <option value="Đã giao" <?php if ($current_status == 'Đã giao') echo 'selected'; ?>>Đã giao</option>
            </select>
            <button type="submit">Cập nhật</button>
        </form>
    </div>
</div>
</section>
</body>
</html>
