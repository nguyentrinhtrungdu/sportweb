<?php
include_once __DIR__ . "/../database.php";
class Order {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function update_order_status($order_id, $status) {
        // Chuyển trạng thái từ tiếng Việt về giá trị lưu trữ trong cơ sở dữ liệu
        $status_map = [
            'Chờ xác nhận' => 'pending',
            'Đã xác nhận' => 'confirmed',
            'Đã vận chuyển' => 'shipped',
            'Đã giao' => 'delivered'
        ];
        
        $status_db = $status_map[$status] ?? 'pending'; // Mặc định 'pending' nếu trạng thái không hợp lệ
    
        // Sử dụng kết nối từ lớp Database
        $conn = $this->db->getConnection();
        $order_id = mysqli_real_escape_string($conn, $order_id);
        $status_db = mysqli_real_escape_string($conn, $status_db);
    
        // Câu truy vấn để cập nhật trạng thái đơn hàng
        $query = "UPDATE tbl_orders SET status = ? WHERE order_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $status_db, $order_id);
        $result = $stmt->execute();
        
        return $result;
    }
    
    
    public function get_order_details($order_id) {
        $query = "SELECT * FROM tbl_orders WHERE order_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function get_order_items($order_id) {
    $query = "SELECT product_name, product_price, product_img, quantity, description 
              FROM order_items 
              WHERE order_id = ?";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    return $stmt->get_result();
}

    public function show_orders() {
        $query = "SELECT o.order_id, u.name AS user_name, o.address, o.total, o.status
                  FROM tbl_orders o
                  JOIN users u ON o.user_id = u.user_id
                  ORDER BY o.order_id DESC";
        
        // Thực thi câu truy vấn và trả về kết quả
        $result = $this->db->select($query);
        return $result;
    }
    

    public function create_order($user_id, $user_name, $address, $total) {
        $query = "INSERT INTO tbl_orders (user_id, user_name, address, total, status) VALUES (?, ?, ?, ?, 'pending')";
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