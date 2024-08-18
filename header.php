<?php
ob_start();
include_once __DIR__ . "/admin/class/category_class.php";
include_once __DIR__ . "/admin/class/brand_class.php";

// Initialize the user name and avatar
$userName = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Khách';
$userArt = isset($_SESSION['user_art']) ? $_SESSION['user_art'] : 'av.jpg';


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



// Handle removal of items from the cart
if (isset($_GET['remove_from_cart'])) {
    $remove_index = (int)$_GET['remove_from_cart'];
    if (isset($_SESSION['cart'][$remove_index])) {
        array_splice($_SESSION['cart'], $remove_index, 1);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

$searchHistory = isset($_SESSION['search_history']) ? $_SESSION['search_history'] : [];
?>

<header class="header">
    <nav class="header__navbar">
        <div class="header__navbar-logo">
            <a href="/" class="header__navbar-link">
                <img src="./assets/img/header/thunderkick_games.png" alt="" class="header__navbar-img">
            </a>
        </div>

        <ul id="nav">
            <?php if ($categories): ?>
                <?php while ($cat = $categories->fetch_assoc()): ?>
                    <li>
                        <a href="<?php 
                            if ($cat['category_name'] === 'TẤT CẢ SẢN PHẨM') {
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
                            <?php if (strtoupper($cat['category_name']) !== 'BẢO HÀNH' && strtoupper($cat['category_name']) !== 'SALE' && strtoupper($cat['category_name']) !== 'TẤT CẢ SẢN PHẨM'): ?>
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
                                            } else {
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
                <li class="header__navbar-item header__navbar-user">
                    <img src="./assets/img/avatar_defaut/<?php echo htmlspecialchars($userArt);?>" alt="" class="header__navbar-user-avatar">
                    <span class="header__navbar-user-name"><?php echo htmlspecialchars($userName); ?></span>
                    <ul class="header__navbar-user-menu">
                        <li class="header__navbar-user-item">
                            <a href="../edit_profile.php">Tài khoản của tôi</a>
                        </li>
                        <li class="header__navbar-user-item">
                            <a href="/myorder.php">Đơn mua</a>
                        </li>
                        <li class="header__navbar-item header__navbar-item--strong header__navbar-item--separate">
                            <a href="../user/logout.php">Đăng xuất</a>
                        </li>
                    </ul>
                </li>
            <?php else: ?>
                <a class="dangnhap-nav" href="modal.php">
                    Đăng nhập
                </a>
            <?php endif; ?>
        </ul>

        <!-- Search -->
        <div class="header-with-search">
            <div class="header__search">
                <div class="header__search-input-wrap">
                    <input type="text" id="search-input" name="q" class="header__search-input" placeholder="Nhập để tìm kiếm sản phẩm">
                    <div class="header__search-history" id="search-history"></div>
                </div>
                <button class="header__search-btn" id="search-btn">
                    <i class="header__search-btn-icon fa-sharp fa-solid fa-magnifying-glass"></i>
                </button>
                <div class="header__cart">
                    <div class="header__cart-wrap">
                        <i class="header__cart-icon fa-sharp fa-solid fa-cart-shopping"></i>
                        <span class="header__cart-notice"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : '0'; ?></span>
                        <!-- Cart -->
                        <div class="header__cart-list">
                            <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                                <h4 class="header__cart-heading">Sản phẩm đã thêm</h4>
                                <ul class="header__cart-list-item">
                                    <?php foreach ($_SESSION['cart'] as $key => $cart_item): ?>
                                        <li class="header__cart-item">
                                            <img src="admin/uploads/<?php echo htmlspecialchars($cart_item['product_img'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($cart_item['product_name']); ?>" class="header__cart-img">
                                            <div class="header__cart-item-info">
                                                <div class="header__cart-item-head">
                                                    <h5 class="header__cart-item-name"><?php echo htmlspecialchars($cart_item['product_name']); ?></h5>
                                                    <div class="header__cart-item-price-wrap">
                                                        <span class="header__cart-item-price"><?php echo number_format($cart_item['product_price'], 0, ',', '.'); ?>đ</span>
                                                        <span class="header__cart-item-multiply">x</span>
                                                        <span class="header__cart-item-qnt"><?php echo htmlspecialchars($cart_item['quantity']); ?></span>
                                                    </div>
                                                </div>
                                                <div class="header__cart-item-body">
                                                    <span class="header__cart-item-description">Size: <?php echo htmlspecialchars($cart_item['size']); ?></span>
                                                    <span class="header__cart-item-remove">
                                                        <a href="?remove_from_cart=<?php echo $key; ?>">Xóa</a>
                                                    </span>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                <a href="thanhtoan.php" class="header__cart-view-cart btn btn--primary">Thanh toán</a>
                            <?php else: ?>
                                <div class="header__cart-list header__cart-list--no-cart">
                                    <img src="./assets/img/header/empty_cart.webp" alt="No products in cart" class="header__cart-no-cart-img">
                                    <p class="header__cart-list-no-cart-msg">Hiện tại không có sản phẩm</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- JavaScript for search history -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const searchHistory = document.getElementById('search-history');
    const searchBtn = document.getElementById('search-btn');

    // Function to perform search
    function performSearch() {
        const query = searchInput.value;
        if (query.length > 0) {
            window.location.href = `search_results.php?q=${encodeURIComponent(query)}`;
        }
    }

    // Event listener for search button click
    searchBtn.addEventListener('click', performSearch);

    // Event listener for Enter key press
    searchInput.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Prevent default form submission
            performSearch();
        }
    });
});
</script>