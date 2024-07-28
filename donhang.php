<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-6.5.2-web/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/donhang.css">
    <title>Đơn Hàng</title>
</head>
<body>
    <?php
    include ("./header.php");
    include_once __DIR__ . "/admin/class/product_class.php";
    
    $productClass = new product();
    $product_id = isset($_GET['product_id']) ? $_GET['product_id'] : 1; // Change this to get the actual product ID
    $all_products = $productClass->show_product();

    $product = null;
    while ($p = $all_products->fetch_assoc()) {
        if ($p['product_id'] == $product_id) {
            $product = $p;
            break;
        }
    }

    if ($product):
    ?>
    <!-- container -->
        <div class="product-detail">
            <div class="product-detail__left">
                <img class="product-detail__img" src="admin/uploads/<?php echo htmlspecialchars($product['product_img'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
            </div>
            <div class="product-detail__right">
                <h2 class="product-detail__name"><?php echo htmlspecialchars($product['product_name']); ?></h2>
                <div class="product-detail__price">
                    <span><?php echo number_format($product['product_price'], 0, ',', '.'); ?>đ</span>
                </div>
                <div class="product-detail__size">
                    <label for="size">Chọn kích thước:</label>
                    <select name="size" id="size">
                        <?php for ($size = 39; $size <= 43; $size++): ?>
                            <option value="<?php echo $size; ?>"><?php echo $size; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="product-detail__buttons">
                    <button class="btn btn--buy">Mua</button>
                    <button class="btn btn--add-to-cart">Thêm vào giỏ hàng</button>
                </div>
            </div>
        </div>
    <?php else: ?>
    <p>Không tìm thấy sản phẩm.</p>
    <?php endif; ?>

    <!-- footer -->
    <?php include ("./footer.php"); ?>

    <!-- Modal layout -->
    <?php include ("./modal.php"); ?>
</body>
</html>
