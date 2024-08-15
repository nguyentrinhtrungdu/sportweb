<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-6.5.2-web/css/all.min.css">
    <title>Search Results</title>
</head>
<body>
    <?php
    session_start();

    include ("./header.php");
    include_once __DIR__ . "/admin/class/product_class.php";

    $productClass = new product();
    $query = isset($_GET['q']) ? $_GET['q'] : '';
    $searchResults = $productClass->search_products($query);
    ?>

    <!-- container -->
    <div class="app__container">
        <div class="grid">
            <div class="grid__row app_content">
                <div class="grid__column-2">
                    <!-- Optional sidebar content can go here -->
                </div>

                <div class="grid__column-10">
                    <div class="home-filter">
                        <h3 class="home-filter-heading">Search Results for: "<?php echo htmlspecialchars($query); ?>"</h3>
                    </div>

                    <div class="home-product">
                        <div class="grid__row">
                            <?php if ($searchResults && $searchResults->num_rows > 0): ?>
                                <?php $i = 0; ?>
                                <?php while ($product = $searchResults->fetch_assoc()): ?>
                                    <?php if ($i % 5 == 0 && $i != 0): ?>
                                        </div><div class="grid__row">
                                    <?php endif; ?>
                                    <div class="grid__column-2-4">
                                        <a class="don-hang-link" href="donhang.php?product_id=<?php echo $product['product_id']; ?>">
                                            <div class="home-product-item">
                                                <div class="home-product-item__img" style="background-image: url('admin/uploads/<?php echo htmlspecialchars($product['product_img'], ENT_QUOTES, 'UTF-8'); ?>');"></div>
                                                <h4 class="home-product-item__name"><?php echo htmlspecialchars($product['product_name']); ?></h4>
                                                <div class="home-product-item__price home-product-item__price-no-sale">
                                                    <span class="home-product-item__price-current"><?php echo number_format($product['product_price'], 0, ',', '.'); ?>đ</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <?php $i++; ?>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <p>Không có sản phẩm nào phù hợp với tìm kiếm của bạn.</p>
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
