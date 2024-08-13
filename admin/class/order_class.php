<?php
include_once __DIR__ . "/../database.php";

class Order {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function update_order_status($order_id, $status) {
        $status_map = [
            'Chờ xác nhận' => 'pending',
            'Đã xác nhận' => 'confirmed',
            'Đang vận chuyển' => 'delivering',
            'Đã giao' => 'delivered'
        ];
        
        $status_db = $status_map[$status] ?? 'pending';
        $conn = $this->db->getConnection();
        $order_id = mysqli_real_escape_string($conn, $order_id);
        $status_db = mysqli_real_escape_string($conn, $status_db);
    
        $query = "UPDATE tbl_orders SET status = ? WHERE order_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $status_db, $order_id);
        return $stmt->execute();
    }

    public function get_order_details($order_id) {
        // Lấy thông tin đơn hàng
        $query = "SELECT * FROM tbl_orders WHERE order_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $order = $stmt->get_result()->fetch_assoc();
    
        // Kiểm tra xem đơn hàng có tồn tại không
        if (!$order) {
            return null; // Nếu không có đơn hàng, trả về null
        }
    
        // Lấy thông tin sản phẩm trong đơn hàng
        $query = "SELECT product_name, product_img, product_price, quantity FROM tbl_order_items WHERE order_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    
        return ['order' => $order, 'items' => $items];
    }

    public function get_order_items($order_id) {
        $query = "SELECT product_name, product_price, product_img, quantity
                  FROM tbl_order_items
                  WHERE order_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function show_orders() {
        $query = "SELECT o.order_id, u.name AS user_name, o.address, o.total, o.status, o.descr
                  FROM tbl_orders o
                  JOIN users u ON o.user_id = u.user_id
                  ORDER BY o.order_id DESC";
        return $this->db->select($query);
    }

    public function create_order($user_id, $user_name, $address, $total, $descr) {
        $query = "INSERT INTO tbl_orders (user_id, user_name, address, total, status, descr) 
                  VALUES (?, ?, ?, ?, 'pending', ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('issds', $user_id, $user_name, $address, $total, $descr);
        $stmt->execute();
        return $this->db->get_last_insert_id(); // Trả về ID của đơn hàng mới tạo
    }

    public function add_order_item($order_id, $product_id, $product_name, $product_img, $product_price, $quantity) {
        $query = "INSERT INTO tbl_order_items (order_id, product_id, product_name, product_img, product_price, quantity) 
                  VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iissdi', $order_id, $product_id, $product_name, $product_img, $product_price, $quantity);
        return $stmt->execute();
    }
}
?>
