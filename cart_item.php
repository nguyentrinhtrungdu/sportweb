<?php
include_once __DIR__ . '/user/connectdb.php'; // Include the database connection file

class CartItem {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Add product to cart
    public function addCartItem($user_id, $product_id, $quantity, $size = 'Unknown') {
        try {
            // First, retrieve the product details from tbl_product
            $sql = "SELECT product_name, product_price, product_img FROM tbl_product WHERE product_id = :product_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->execute();
    
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if (!$product) {
                // If the product is not found, return false
                return false;
            }
    
            // Extract product details
            $product_name = $product['product_name'];
            $product_price = $product['product_price'];
            $product_img = $product['product_img'];
    
            // Insert the cart item into user_cart with product details
            $sql = "INSERT INTO user_cart (user_id, product_id, quantity, size, product_name, product_price, product_img) 
                    VALUES (:user_id, :product_id, :quantity, :size, :product_name, :product_price, :product_img)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->bindParam(':size', $size, PDO::PARAM_STR);
            $stmt->bindParam(':product_name', $product_name, PDO::PARAM_STR);
            $stmt->bindParam(':product_price', $product_price, PDO::PARAM_STR);
            $stmt->bindParam(':product_img', $product_img, PDO::PARAM_STR);
    
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error adding cart item: " . $e->getMessage());
            return false;
        }
    }
    
    // Get items in user's cart
    public function getCartItems($user_id) {
        try {
            $sql = "SELECT uc.*, p.product_name AS item_name, uc.product_price AS item_price, uc.product_img AS item_image
                    FROM user_cart uc
                    JOIN tbl_product p ON uc.product_id = p.product_id
                    WHERE uc.user_id = :user_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error retrieving cart items: " . $e->getMessage());
            return [];
        }
    }

    // Delete cart items when checking out
    public function deleteCartItem($user_id, $product_id) {
        try {
            $sql = "DELETE FROM user_cart WHERE user_id = :user_id AND product_id = :product_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error deleting cart item: " . $e->getMessage());
            return false;
        }
    }

    // Check if product is already in the cart
    public function checkIfExists($user_id, $product_id) {
        try {
            $sql = "SELECT * FROM user_cart WHERE user_id = :user_id AND product_id = :product_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error checking cart item existence: " . $e->getMessage());
            return false;
        }
    }

    // Update quantity of product in cart
    public function updateCartItem($user_id, $product_id, $quantity) {
        try {
            $sql = "UPDATE user_cart SET quantity = :quantity WHERE user_id = :user_id AND product_id = :product_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error updating cart item: " . $e->getMessage());
            return false;
        }
    }
}

?>
