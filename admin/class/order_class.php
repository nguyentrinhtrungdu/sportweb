<?php
include_once __DIR__ . "/../database.php";
class Order {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function create_order($user_id, $user_name, $address, $total) {
        $query = "INSERT INTO tbl_orders (user_id, user_name, address, total, status) VALUES (?, ?, ?, ?, 'Pending')";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('isss', $user_id, $user_name, $address, $total);
        $stmt->execute();

        return $this->db->get_last_insert_id(); // Return the last inserted ID
    }

    public function add_order_item($order_id, $product_id, $product_name, $product_img, $product_price, $quantity) {
        $query = "INSERT INTO tbl_order_items (order_id, product_id, product_name, product_img, product_price, quantity) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iissdi', $order_id, $product_id, $product_name, $product_img, $product_price, $quantity);
        $stmt->execute();
    }
}
?>
