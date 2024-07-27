<?php 
include "header.php";
include "slider.php";
include "class/product_class.php";

$product = new product();

if (!isset($_GET['product_id']) || $_GET['product_id'] == NULL) {
    echo "<script>window.location = 'product.php'</script>";
} else {
    $product_id = $_GET['product_id'];
}

$get_product = $product->get_product($product_id);
if ($get_product) {
    $result = $get_product->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST['product_name'];
    $category_id = $_POST['category_id'];
    $brand_id = $_POST['brand_id'];
    $product_price = $_POST['product_price'];
    $product_img = $_FILES['product_img']['name'];

    if ($product_img) {
        $file_target = basename($product_img);
        $file_size = $_FILES['product_img']['size'];
        $file_type = strtolower(pathinfo($product_img, PATHINFO_EXTENSION));

        if (file_exists("./uploads/$file_target")) {
            $alert = "File đã tồn tại";
        } elseif ($file_type != "jpg" && $file_type != "png" && $file_type != "jpeg") {
            $alert = "Chỉ chọn file jpg, png, jpeg";
        } elseif ($file_size > 1000000) {
            $alert = "File không được lớn hơn 1MB";
        } else {
            move_uploaded_file($_FILES['product_img']['tmp_name'], "./uploads" . $product_img);
        }
    } else {
        $product_img = $result['product_img']; // giữ nguyên ảnh cũ nếu không có ảnh mới
    }

    $update_product = $product->update_product($product_name, $category_id, $brand_id, $product_price, $product_img, $product_id);
}
?>

<div class="admin-content-right">
    <div class="admin-content-right-product_add">
        <h1>Sửa sản phẩm</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="">Nhập tên sản phẩm <span style="color: red;">*</span></label>
            <input required name="product_name" type="text" value="<?php echo $result['product_name']; ?>">
            
            <label for="">Chọn danh mục <span style="color: red;">*</span></label>
            <select name="category_id" id="">
                <option value="#">--Chọn--</option>
                <?php
                $show_category = $product->show_category();
                if ($show_category) {
                    while ($category_result = $show_category->fetch_assoc()) {
                        $selected = $category_result['category_id'] == $result['category_id'] ? 'selected' : '';
                        echo "<option value='{$category_result['category_id']}' $selected>{$category_result['category_name']}</option>";
                    }
                }
                ?>
            </select>
            
            <label for="">Chọn loại sản phẩm <span style="color: red;">*</span></label>
            <select name="brand_id" id="">
                <option value="#">--Chọn--</option>
                <?php
                $show_brand = $product->show_brand();
                if ($show_brand) {
                    while ($brand_result = $show_brand->fetch_assoc()) {
                        $selected = $brand_result['brand_id'] == $result['brand_id'] ? 'selected' : '';
                        echo "<option value='{$brand_result['brand_id']}' $selected>{$brand_result['brand_name']}</option>";
                    }
                }
                ?>
            </select>
            
            <label for="">Giá sản phẩm <span style="color: red;">*</span></label>
            <input required name="product_price" type="text" value="<?php echo $result['product_price']; ?>">
            
            
            
            
            <label for="">Ảnh sản phẩm <span style="color: red;">*</span></label>
            <input type="file" name="product_img">
            <img src="./uploads<?php echo $result['product_img']; ?>" alt="" width="80">
            
            <button type="submit">Sửa</button>
        </form>
    </div>
</div>
</section>
</body>
</html>
