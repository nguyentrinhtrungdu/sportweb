<?php 

include "header.php";
include "slider.php";
include "class/product_class.php";
?>

    <section class="admin-content">   
        <div class="admin-content-right">
            <div class="admin-content-right-order_list">
                <h1>Danh sách đơn hàng</h1>
                <table>
                    <tr>
                        <th>STT</th>
                        <th>Mã đơn hàng</th>
                        <th>Tên người dùng</th>
                        <th>Địa chỉ</th>
                        <th>Tổng giá</th>
                        <th>Trạng thái</th>
                        <th>Mô tả</th>
                        <th>Thời gian đặt</th>
                        <th>Chi tiết</th>
                        <th>Thao tác</th>
                    </tr>
                    <?php
                    include_once 'class/order_class.php';
                    $order = new Order();
                    $orders = $order->show_orders();

                    if ($orders) {
                        $i = 0;
                        while ($row = $orders->fetch_assoc()) {
                            $i++;
                            echo "<tr>";
                            echo "<td>" . $i . "</td>";
                            echo "<td>" . $row['order_id'] . "</td>";
                            echo "<td>" . $row['user_name'] . "</td>";
                            echo "<td>" . $row['address'] . "</td>";
                            echo "<td>" . $row['total'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
                            echo "<td>" . $row['descr'] . "</td>";
                            echo "<td>" . date('d-m-Y H:i:s', strtotime($row['created_at'])) . "</td>"; 
                            echo "<td><a href='orderdetails.php?order_id=" . $row['order_id'] . "'>Chi tiết</a></td>";
                            echo "<td><a href='orderstatusupdate.php?order_id=" . $row['order_id'] . "'>Sửa trạng thái</a></td>"; // Nút sửa trạng thái
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>Không có đơn hàng nào</td></tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </section>
</body>
</html>
