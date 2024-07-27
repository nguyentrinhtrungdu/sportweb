<?php
session_start();
ob_start();
include_once __DIR__ . "/admin/class/category_class.php";
include_once __DIR__ . "/admin/class/brand_class.php";

// Instantiate category and brand classes
$category = new category();
$brand = new brand();

// Fetch categories and brands
$categories = $category->show_category();
$brands = $brand->show_brand();

// Organize brands by category_id
$brandsByCategory = [];
while ($brand = $brands->fetch_assoc()) {
    $brandsByCategory[$brand['category_id']][] = $brand;
}

// Check if user is logged in and their role
$isLoggedIn = isset($_SESSION['user_id']);
$isAdmin = $isLoggedIn && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
?>

<header class="header">
    <nav class="header__navbar">
        <div class="header__navbar-logo">
            <a href="/" class="header__navbar-link">
                <img src="https://sgweb.vn/wp-content/uploads/2022/12/logo-shop-quan-ao5.png" alt="" class="header__navbar-img">
            </a>
        </div>

        <ul id="nav">
        <?php if ($categories): ?>
            <?php while ($cat = $categories->fetch_assoc()): ?>
                <li>
                    <a href="<?php 
                        // Adjust the link based on category name
                        if ($cat['category_name'] === 'GIÀY BÓNG ĐÁ') {
                            echo 'allproduct.php';
                        } elseif ($cat['category_name'] === 'THƯƠNG HIỆU') {
                            echo 'allproduct.php';
                        } elseif ($cat['category_name'] === 'PHỤ KIỆN') {
                            echo 'phukien.php';
                        } elseif ($cat['category_name'] === 'DỊCH VỤ') {
                            echo 'service.php';
                        } elseif ($cat['category_name'] === 'BẢO HÀNH') {
                            echo 'baohanh.php';
                        } 
                    ?>">
                        <?php echo htmlspecialchars($cat['category_name']); ?>
                        <?php if (strtoupper($cat['category_name']) !== 'BẢO HÀNH' && strtoupper($cat['category_name' ]) !== 'SALE' && strtoupper($cat['category_name' ]) !== 'GIÀY BÓNG ĐÁ'): ?>
                            <i class="icon-down fa-sharp fa-solid fa-chevron-down"></i>
                        <?php endif; ?>
                    </a>
                    <ul class="subnav">
                        <?php if (isset($brandsByCategory[$cat['category_id']])): ?>
                            <?php foreach ($brandsByCategory[$cat['category_id']] as $brand): ?>
                                <li>
                                    <a href="<?php 
                                        // Adjust the link based on brand name
                                        
                                         if ($brand['brand_name'] === 'GIÀY BÓNG ĐÁ NIKE') {
                                            echo '/nike.php';
                                        } elseif ($brand['brand_name'] === 'GIÀY BÓNG ĐÁ ADIDAS') {
                                            echo '/adidas.php';
                                        } elseif ($brand['brand_name'] === 'GIÀY BÓNG ĐÁ PUMA') {
                                            echo '/puma.php';
                                        } elseif ($brand['brand_name'] === 'GIÀY BÓNG ĐÁ MIZUNO') {
                                            echo '/mizuno.php';
                                        } elseif ($brand['brand_name'] === 'GIÀY BÓNG ĐÁ KAMITO') {
                                            echo '/kamito.php';
                                        } elseif ($brand['brand_name'] === 'GIÀY BÓNG ĐÁ ZOCKER') {
                                            echo '/zocker.php';
                                        } elseif ($brand['brand_name'] === 'IN BALO - QUẦN ÁO') {
                                            echo '/service.php';
                                        } elseif ($brand['brand_name'] === 'QUẢ BÓNG ĐÁ') {
                                            echo '/bong.php';
                                        } elseif ($brand['brand_name'] === 'GĂNG TAY') {
                                            echo '/gang.php';
                                        } elseif ($brand['brand_name'] === 'ÁO BÓNG ĐÁ') {
                                            echo '/ao.php';
                                        } elseif ($brand['brand_name'] === 'BALO TÚI XÁCH') {
                                            echo '/balo.php';
                                        } elseif ($brand['brand_name'] === 'SỮA CHỬA GIÀY') {
                                            echo '/repairShoes.php';
                                        }
                                         else {
                                            echo '/brand.php?id=' . htmlspecialchars($brand['brand_id']);
                                        }
                                    ?>">
                                        <?php echo htmlspecialchars($brand['brand_name']); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endwhile; ?>
        <?php endif; ?>
        </ul>
        <ul class="header__navbar-list">
            <?php if ($isLoggedIn): ?>
                <li class="header__navbar-item header__navbar-item--strong header__navbar-item--separate">
                    <a href="./user/logout.php">Đăng xuất</a>
                </li>
            <?php else: ?>
                <li class="header__navbar-item header__navbar-item--strong header__navbar-item--separate register-form">Đăng ký</li>
                <li class="header__navbar-item header__navbar-item--strong login-form">Đăng nhập</li>
            <?php endif; ?>
        </ul>


    <!-- Search -->
    <div class="header-with-search">
        <div class="header__search">
            <div class="header__search-input-wrap">
                <input type="text" class="header__search-input" placeholder="Nhập để tìm kiếm sản phẩm">
                <div class="header__search-history">
                    <h3 class="header__search-history-heading">Lịch sử tìm kiếm</h3>
                    <ul class="header__search-history-list">
                        <li class="header__search-history-item">
                            <a href="">Áo brazil</a>
                        </li>
                        <li class="header__search-history-item">
                            <a href="">Quần kaki</a>
                        </li>
                    </ul>
                </div>
            </div>
            <button class="header__search-btn">
                <i class="header__search-btn-icon fa-sharp fa-solid fa-magnifying-glass"></i>
            </button>
            <div class="header__cart">
                <div class="header__cart-wrap">
                    <i class="header__cart-icon fa-sharp fa-solid fa-cart-shopping"></i>
                    <span class="header__cart-notice">3</span>
                    <!-- No cart -->
                    <div class="header__cart-list">
                        <img src="./asset/img/no_cart.png" alt="" class="header__cart-no-cart-img">
                        <p class="header__cart-list-no-cart-msg">
                            Chưa có sản phẩm
                        </p>
                        <h4 class="header__cart-heading">Sản phẩm đã thêm</h4>
                        <ul class="header__cart-list-item">
                            <!-- Cart item -->
                            <li class="header__cart-item">
                                <img src="https://d2308c8b.rocketcdn.me/wp-content/uploads/2022/03/20-06.jpeg" alt="" class="header__cart-img">
                                <div class="header__cart-item-info">
                                    <div class="header__cart-item-head">
                                        <h5 class="header__cart-item-name">Áo bóng đá Nam</h5>
                                        <div class="header__cart-item-price-wrap">
                                            <span class="header__cart-item-price">700.000đ</span>
                                            <span class="header__cart-item-multiply">x</span>
                                            <span class="header__cart-item-qnt">1</span>
                                        </div>
                                    </div>
                                    <div class="header__cart-item-body">
                                        <span class="header__cart-item-description">
                                            Phân loại: Bạc
                                        </span>
                                        <span class="header__cart-item-remove">Xóa</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="header__cart-footer">
                            <a href="#" class="header__cart-view">Xem giỏ hàng</a>
                            <a href="#" class="header__cart-checkout">Thanh toán</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
