<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-6.5.2-web/css/all.min.css">
    <title>BALO TÚI XÁCH</title>
</head>
<body>
    <?php
    include ("./header.php");
    include_once __DIR__ . "/admin/class/product_class.php";

    $productClass = new product();
    $all_products = $productClass->show_product();
    ?>

    <!-- container -->
    <div class="app__container">
        <div class="grid">
            <div class="grid__row app_content">
                <div class="grid__column-2">
                    <nav class="category">
                        <h3 class="category__heading">
                            <i class="category__heading-icon fa-solid fa-list"></i>
                            THƯƠNG HIỆU
                        </h3>
                        <ul class="brand-list">
                            <li><a href="#"><input type="checkbox" name="brand" id="nike"><label for="nike">Nike</label></a></li>
                            <li><a href="#"><input type="checkbox" name="brand" id="adidas"><label for="adidas">Adidas</label></a></li>
                            <li><a href="#"><input type="checkbox" name="brand" id="puma"><label for="puma">Puma</label></a></li>
                            <li><a href="#"><input type="checkbox" name="brand" id="mizuno"><label for="mizuno">Mizuno</label></a></li>
                            <li><a href="#"><input type="checkbox" name="brand" id="kamito"><label for="kamito">Kamito</label></a></li>
                            <li><a href="#"><input type="checkbox" name="brand" id="zocker"><label for="zocker">Zocker</label></a></li>
                        </ul>
                    </nav>

                    <nav class="category">
                        <h3 class="category__heading">
                            <i class="category__heading-icon fa-solid fa-list"></i>
                            GIÁ
                        </h3>
                        <ul class="brand-list">
                            <li><a href="#"><input type="checkbox" id="all"><label for="all">Tất cả</label></a></li>
                            <li><a href="#"><input type="checkbox" id="range1"><label for="range1">0 VNĐ ~ 1.000.000 VNĐ</label></a></li>
                            <li><a href="#"><input type="checkbox" id="range2"><label for="range2">1.000.000 VNĐ ~ 2.000.000 VNĐ</label></a></li>
                            <li><a href="#"><input type="checkbox" id="range3"><label for="range3">2.000.000 VNĐ ~ 3.000.000VNĐ</label></a></li>
                            <li><a href="#"><input type="checkbox" id="range4"><label for="range4">3.000.000 VNĐ ~ 5.000.000 VNĐ</label></a></li>
                            <li><a href="#"><input type="checkbox" id="range5"><label for="range5">Trên 5.000.000 VNĐ</label></a></li>
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
                            <?php if ($all_products && $all_products->num_rows > 0): ?>
                                <?php while ($product = $all_products->fetch_assoc()): ?>
                                    <?php if ($product['brand_name'] == "BALO TÚI XÁCH"): ?>
                                        <div class="grid__column-2-4">
                                            <div class="home-product-item">
                                                <div class="home-product-item__img" style="background-image: url('admin/uploads/<?php echo htmlspecialchars($product['product_img'], ENT_QUOTES, 'UTF-8'); ?>');"></div>
                                                <h4 class="home-product-item__name"><?php echo htmlspecialchars($product['product_name']); ?></h4>
                                                <div class="home-product-item__price home-product-item__price-no-sale">
                                                    <span class="home-product-item__price-current"><?php echo number_format($product['product_price'], 0, ',', '.'); ?>đ</span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endwhile; ?>
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

    <!-- Modal layout -->
    <?php include ("./modal.php"); ?>
</body>
</html>
