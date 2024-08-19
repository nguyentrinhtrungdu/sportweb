<?php
session_start();
ob_start();
include("./header.php");
include_once __DIR__ . "/admin/class/product_class.php";
include_once __DIR__ . "/user/connectdb.php";
include_once __DIR__ . "/cart_item.php";

$cartItem = new CartItem($pdo);

// Kiểm tra nếu người dùng đã đăng nhập
$is_logged_in = isset($_SESSION['user_id']);

// Xử lý xóa sản phẩm khỏi giỏ hàng
if (isset($_GET['remove_from_cart'])) {
    $remove_index = (int)$_GET['remove_from_cart'];
    if (isset($_SESSION['cart'][$remove_index])) {
        array_splice($_SESSION['cart'], $remove_index, 1);
        header("Location: donhang.php"); // Điều hướng về trang giỏ hàng
        exit();
    }
}

// Lấy thông tin sản phẩm
$productClass = new product();
$product_id = isset($_GET['product_id']) ? (int)$_GET['product_id'] : 1;
$all_products = $productClass->show_product();

$product = null;
while ($p = $all_products->fetch_assoc()) {
    if ($p['product_id'] == $product_id) {
        $product = $p;
        break;
    }
}

// Xử lý hành động thêm vào giỏ hàng
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($product) {
        $size = $_POST['size'] ?? 'Unknown'; // Cung cấp giá trị mặc định cho kích thước
        $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
        $user_id = $_SESSION['user_id'] ?? null;

        if ($user_id) {
            // Kiểm tra nếu sản phẩm đã có trong giỏ hàng
            $existingItem = $cartItem->checkIfExists($user_id, $product['product_id']);
            
            if ($existingItem) {
                // Cập nhật số lượng nếu sản phẩm đã có
                $cartItem->updateCartItem($user_id, $product['product_id'], $existingItem['quantity'] + $quantity);
            } else {
                // Thêm sản phẩm vào giỏ hàng nếu chưa có
                $cartItem->addCartItem($user_id, $product['product_id'], $quantity, $size);
            }

            // Điều hướng sau khi thêm vào giỏ hàng hoặc mua ngay
            if (isset($_POST['buy_now'])) {
                if ($is_logged_in) {
                    header("Location: thanhtoan.php");
                    exit();
                } else {
                    header("Location: modal.php?redirect=" . urlencode($_SERVER['REQUEST_URI']));
                    exit();
                }
            } else {
                header("Location: " . $_SERVER['REQUEST_URI']);
                exit();
            }
        } else {
            // Xử lý trường hợp người dùng chưa đăng nhập
            header("Location: modal.php?redirect=" . urlencode($_SERVER['REQUEST_URI']));
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-6.5.2-web/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/donhang.css">
    <title>Chi Tiết Sản Phẩm</title>
    <style>
        .quantity-controls {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .quantity-controls button {
            background: #ddd;
            border: none;
            padding: 8px;
            font-size: 1.2rem;
            cursor: pointer;
        }
        .quantity-controls input {
            width: 50px;
            text-align: center;
            border: 1px solid #ddd;
            padding: 5px;
            margin: 0 5px;
        }
    </style>
</head>
<body>
    <div class="product-detail">
        <?php if ($product !== null): ?>
            <div class="product-detail__left">
                <img class="product-detail__img" src="admin/uploads/<?php echo htmlspecialchars($product['product_img'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
            </div>
            <div class="product-detail__right">
                <h2 class="product-detail__name"><?php echo htmlspecialchars($product['product_name']); ?></h2>
                <div class="product-detail__price">
                    <span><?php echo number_format($product['product_price'], 0, ',', '.'); ?>đ</span>
                </div>
                <form method="post" action="">
                    <?php
                    $showSizeOptions = false;
                    if ($product['brand_name'] === "GĂNG TAY" || $product['category_name'] === "THƯƠNG HIỆU") {
                        $showSizeOptions = true;
                    }
                    ?>

                    <?php if ($showSizeOptions): ?>
                        <label for="size">Chọn kích thước:</label>
                        <select name="size" id="size">
                            <?php 
                            if ($product['brand_name'] === "GĂNG TAY") {
                                for ($size = 6; $size <= 10; $size++): ?>
                                    <option value="<?php echo htmlspecialchars($size); ?>"><?php echo htmlspecialchars($size); ?></option>
                                <?php endfor;
                            } else if ($product['category_name'] === "THƯƠNG HIỆU") {
                                for ($size = 39; $size <= 43; $size++): ?>
                                    <option value="<?php echo htmlspecialchars($size); ?>"><?php echo htmlspecialchars($size); ?></option>
                                <?php endfor;
                            }
                            ?>
                        </select>
                    <?php endif; ?>

                    <div class="product-detail__quantity">
                        <label for="quantity">Số lượng:</label>
                        <div class="quantity-controls">
                            <button type="button" id="decrement">-</button>
                            <input type="number" id="quantity" name="quantity" value="1" min="1">
                            <button type="button" id="increment">+</button>
                        </div>
                    </div>
                    <div class="product-detail__buttons">
                        <button type="submit" name="buy_now" class="btn btn--buy">Mua ngay</button>
                        <button type="submit" name="add_to_cart" class="btn btn--add-to-cart">Thêm vào giỏ hàng</button>
                    </div>
                </form>
            </div>
        <?php else: ?>
            <p>Không tìm thấy sản phẩm.</p>
        <?php endif; ?>
    </div>

    <!-- footer -->
    <?php include("./footer.php"); ?>

    <script>
        document.getElementById('increment').addEventListener('click', function() {
            var quantityInput = document.getElementById('quantity');
            var currentValue = parseInt(quantityInput.value, 10);
            quantityInput.value = currentValue + 1;
        });

        document.getElementById('decrement').addEventListener('click', function() {
            var quantityInput = document.getElementById('quantity');
            var currentValue = parseInt(quantityInput.value, 10);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });
    </script>
</body>
</html>
