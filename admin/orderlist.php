<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách đơn hàng</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>TOP</h1>
    </header>   

    <section class="admin-content">
        <div class="admin-content-left">
            <ul>
                <li><a href="#">Danh mục </a>
                    <ul>
                        <li><a href="categoryadd.php">Thêm danh mục</a></li>
                        <li><a href="categorylist.php">Danh sách danh mục</a></li>
                    </ul>
                </li>
                <li><a href="#">Loại sản phẩm </a>
                    <ul>
                        <li><a href="brandadd.php">Thêm loại sản phẩm</a></li>
                        <li><a href="brandlist.php">Danh loại loại sản phẩm</a></li>
                    </ul>
                </li>
                <li><a href="#">Sản phẩm </a>
                    <ul>
                        <li><a href="productadd.php">Thêm sản phẩm</a></li>
                        <li><a href="productlist.php">Danh sách sản phẩm</a></li>
                    </ul>
                </li>
                <li><a href="#">Đơn hàng</a>
                    <ul>
                        <li><a href="orderlist.php">Danh sách đơn hàng</a></li>
                    </ul>
                </li>
            </ul>
        </div>
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
                            echo "<td>" . $row['status'] . "</td>"; // Hiển thị trạng thái
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
