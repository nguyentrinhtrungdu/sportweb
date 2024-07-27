<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-6.5.2-web/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <?php
    include ("./header.php");
    include ("./admin/class/product_class.php");

    // Instantiate the product class
    $productClass = new product();

    // Fetch all products from the database
    $all_products = $productClass->show_product(); // Ensure this method exists and returns products
    ?>
    <!-- container -->
    <div class="app__container">
        <div class="grid">
            <div class="grid__row app_content">
                <div class="grid__column-2">
                    <nav class="category">
                        <h3 class="category__heading">
                            <i class="category__heading-icon fa-solid fa-list"></i>
                            Danh mục
                        </h3>
                        <ul class="category-list">
                            <!-- Category items here -->
                        </ul>
                    </nav>

                    <nav class="category">
                        <h3 class="category__heading">
                            <i class="category__heading-icon fa-solid fa-list"></i>
                            THƯƠNG HIỆU
                        </h3>
                        <ul class="brand-list">
                            <!-- Brand items here -->
                        </ul>
                    </nav>

                    <nav class="category">
                        <h3 class="category__heading">
                            <i class="category__heading-icon fa-solid fa-list"></i>
                            GIÁ
                        </h3>
                        <ul class="brand-list">
                            <!-- Price filter items here -->
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

                        <div class="home-filter__page">
                            <span class="home-filter__page-num">
                                <span class="home-filter__page-current">1</span>/3
                            </span>
                            <div class="home-filter__page-control">
                                <a href="#" class="home-filter__page-btn home-filter__page-btn-disabled">
                                    <i class="home-filter__page-icon fa-solid fa-chevron-left"></i>
                                </a>
                                <a href="/allproductpage2.php" class="home-filter__page-btn">
                                    <i class="home-filter__page-icon fa-solid fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="home-product">
                        <div class="grid__row">
                            <?php if ($all_products && $all_products->num_rows > 0): ?>
                                <?php while ($product = $all_products->fetch_assoc()): ?>
                                    <div class="grid__column-2-4">
                                        <div class="home-product-item">
                                            <div class="home-product-item__img" style="background-image: url('.admin/uploads/<?php echo htmlspecialchars($product['product_img'], ENT_QUOTES, 'UTF-8'); ?>');"></div>
                                            <h4 class="home-product-item__name"><?php echo htmlspecialchars($product['product_name']); ?></h4>
                                            <div class="home-product-item__price home-product-item__price-no-sale">
                                                <span class="home-product-item__price-current"><?php echo number_format($product['product_price'], 0, ',', '.'); ?>đ</span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <p>Không có sản phẩm nào.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-container">
                        <ul class="pagination">
                            <li><a href="#">&laquo;</a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="allproductpage2.php">2</a></li>
                            <li><a href="allproductpage3.php">3</a></li>
                            <li><a href="allproductpage2.php">&raquo;</a></li>
                        </ul>
                    </div>
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
