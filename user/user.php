<?php
include_once __DIR__ . '/connectdb.php'; // Bao gồm tệp kết nối cơ sở dữ liệu

class User {
    private $pdo;

    public function __construct() {
        global $pdo; // Sử dụng biến kết nối PDO từ tệp connectdb.php
        $this->pdo = $pdo;
    }

    // Đăng ký người dùng mới
    public function register($name, $password, $email, $address) {
        try {
            $sql = "INSERT INTO users (name, pass, email, address, role) VALUES (:name, :password, :email, :address, 'user')";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':address', $address);
    
            if ($stmt->execute()) {
                return true;
            } else {
                // Log errors
                error_log("Database error: " . print_r($stmt->errorInfo(), true));
                return false;
            }
        } catch (PDOException $e) {
            error_log("PDO error: " . $e->getMessage());
            return false;
        }
    }

    // Xử lý đăng nhập
    public function login($email, $password) {
        // Truy vấn kiểm tra email và mật khẩu
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email AND pass = :pass");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pass', $password);
        $stmt->execute();

        // Nếu có kết quả thì đăng nhập thành công
        if ($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }

    // Các phương thức khác
    public function getUserId($email) {
        $sql = "SELECT user_id FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ? $user['user_id'] : null;
    }

    public function getUserRole($email) {
        $sql = "SELECT role FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ? $user['role'] : null;
    }

    public function getUsernameByEmail($email) {
        $sql = "SELECT name FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ? $user['name'] : null;
    }
}
?>
