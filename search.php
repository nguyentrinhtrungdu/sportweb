<?php
session_start();
include_once __DIR__ . "/admin/class/product_class.php";

// Create a new instance of the product class
$productClass = new product();

// Get the search query from the URL
$searchQuery = isset($_GET['q']) ? $_GET['q'] : '';

// Fetch products that match the search query
$searchResults = $productClass->search_products($searchQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="path/to/your/styles.css">
</head>
<body>
    <header class="header">
        <!-- Include your header code here -->
    </header>

    <main>
        <h1>Kết quả tìm kiếm cho: <?php echo htmlspecialchars($searchQuery); ?></h1>
        <?php if ($searchResults->num_rows > 0): ?>
            <ul class="search-results">
                <?php while ($product = $searchResults->fetch_assoc()): ?>
                    <li>
                        <a href="product.php?id=<?php echo $product['product_id']; ?>">
                            <img src="admin/uploads/<?php echo htmlspecialchars($product['product_img']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                            <span><?php echo htmlspecialchars($product['product_name']); ?></span>
                            <span><?php echo number_format($product['product_price'], 0, ',', '.'); ?>đ</span>
                        </a>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>Không tìm thấy sản phẩm nào.</p>
        <?php endif; ?>
    </main>
  <script src="/search.js"></script>
</body>
</html>
