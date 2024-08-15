<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-6.5.2-web/css/all.min.css">
    <title>GIÀY BÓNG ĐÁ PUMA</title>
</head>
<body>
    
    <?php
    session_start();

    include ("./header.php");
    include_once __DIR__ . "/admin/class/product_class.php";

    $productClass = new product();
    $all_products = $productClass->show_product();
    // Get filters from query string if exists
    $brand_filter = isset($_GET['brand']) ? $_GET['brand'] : 'GIÀY BÓNG ĐÁ PUMA';
    $price_filter = isset($_GET['price']) ? $_GET['price'] : 'all';

    // Define price ranges
    $price_ranges = [
        'all' => 'Tất cả',
        '0-1000000' => '0 VNĐ ~ 1.000.000 VNĐ',
        '1000000-2000000' => '1.000.000 VNĐ ~ 2.000.000 VNĐ',
        '2000000-3000000' => '2.000.000 VNĐ ~ 3.000.000 VNĐ',
        '3000000-5000000' => '3.000.000 VNĐ ~ 5.000.000 VNĐ',
        '5000000-' => 'Trên 5.000.000 VNĐ'
    ];

    // Filter products based on brand and price range
    $filtered_products = [];
    while ($product = $all_products->fetch_assoc()) {
        if ($product['brand_name'] === $brand_filter) {
            if ($price_filter === 'all') {
                $filtered_products[] = $product;
            } else {
                list($min_price, $max_price) = explode('-', $price_filter);
                if (($min_price === '' || $product['product_price'] >= $min_price) &&
                    ($max_price === '' || $product['product_price'] <= $max_price)) {
                    $filtered_products[] = $product;
                }
            }
        }
    }
    ?>

    <!-- container -->
    <div class="app__container">
        <div class="grid">
            <div class="grid__row app_content">
                <div class="grid__column-2">
                    <nav class="category">
                        <h3 class="category__heading">
                            <i class="category__heading-icon fa-solid fa-list"></i>
                            GIÁ
                        </h3>
                        <ul class="brand-list">
                            <?php foreach ($price_ranges as $range_key => $range_label): ?>
                                <li>
                                    <form action="puma.php" method="get">
                                        <input type="hidden" name="brand" value="<?php echo htmlspecialchars($brand_filter); ?>">
                                        <input type="checkbox" id="<?php echo $range_key; ?>" name="price" value="<?php echo $range_key; ?>" <?php echo ($price_filter == $range_key) ? 'checked' : ''; ?> onchange="this.form.submit()">
                                        <label for="<?php echo $range_key; ?>"><?php echo $range_label; ?></label>
                                    </form>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                    <nav>
                        <a href="">
                            <img class="banner-sale" src="https://theme.hstatic.net/1000061481/1001035882/14/banner-left-col.jpg?v=1897" alt="">
                        </a>
                    </nav>
                </div>

                <div class="grid__column-10">
                    <div class="home-filter">
                        <div class="button-container">
                            <button class="square-button">
                                <div class="squares">
                                    <div class="square"></div>
                                    <div class="square"></div>
                                    <div class="square"></div>
                                    <div class="square"></div>
                                </div>
                            </button>
                        </div>
                    </div>

                    <div class="home-product">
                        <div class="grid__row">
                            <?php if (!empty($filtered_products)): ?>
                                <?php foreach ($filtered_products as $product): ?>
                                    <a class="don-hang-link" href="donhang.php?product_id=<?php echo $product['product_id']; ?>" class="home-product-item-link">
                                    <div class="grid__column-2-4">
                                        <div class="home-product-item">
                                            <div class="home-product-item__img" style="background-image: url('admin/uploads/<?php echo htmlspecialchars($product['product_img'], ENT_QUOTES, 'UTF-8'); ?>');"></div>
                                            <h4 class="home-product-item__name"><?php echo htmlspecialchars($product['product_name']); ?></h4>
                                            <div class="home-product-item__price home-product-item__price-no-sale">
                                                <span class="home-product-item__price-current"><?php echo number_format($product['product_price'], 0, ',', '.'); ?>đ</span>
                                            </div>
                                        </div>
                                    </a>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>Không có sản phẩm nào.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Pagination -->

                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include ("./footer.php"); ?>
</body>
</html>
