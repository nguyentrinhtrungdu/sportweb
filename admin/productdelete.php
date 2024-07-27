<?php 
include "header.php";
include "slider.php";
include "class/product_class.php";

// Kiểm tra nếu ID sản phẩm đã được gửi qua URL
if (isset($_GET['product_id']) && !empty($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Tạo đối tượng sản phẩm
    $product = new product();

    // Gọi phương thức xóa sản phẩm
    $delete_product = $product->delete_product($product_id);

    if ($delete_product) {
        echo "<script>alert('Sản phẩm đã được xóa thành công.'); window.location='./productlist.php';</script>";
    } else {
        echo "<script>alert('Có lỗi xảy ra khi xóa sản phẩm.'); window.location='./productlist.php';</script>";
    }
} else {
    echo "<script>alert('ID sản phẩm không hợp lệ.'); window.location='./productlist.php';</script>";
}
?>
