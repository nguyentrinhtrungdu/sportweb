<?php
include_once __DIR__ . '/connectdb.php'; // Bao gồm tệp kết nối cơ sở dữ liệu

class User {
    private $pdo;

    public function __construct() {
        global $pdo; // Sử dụng biến kết nối PDO từ tệp connectdb.php
        $this->pdo = $pdo;
    }
    
    // Đăng ký người dùng mới
    public function register($name, $password, $email, $address, $num) {
        try {
            // Adjusted SQL to match all columns except the auto-incrementing `user_id`
            $sql = "INSERT INTO users (pass, email, role, name, num, address) VALUES (:password, :email, 'user', :name, :num, :address)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':num', $num);
            $stmt->bindParam(':address', $address);
    
            if ($stmt->execute()) {
                return true;
            } else {
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

    public function get_user_by_id($user_id) {
        $query = "SELECT * FROM users WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($query);
    
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
    
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    }
    public function getAllUsers() {
        $sql = "SELECT * FROM users";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        
        return $stmt;
    }

    public function delete_account($user_id) {
        $query = "DELETE FROM users WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            header('Location: accountlist.php');
            return true;
        } else {
            return false;
        }
    }

    public function updateUser($user_id, $name, $email, $num, $address, $role) {
        try {
            $stmt = $this->pdo->prepare("UPDATE users SET name = :name, email = :email, num = :num, address = :address, role = :role WHERE user_id = :user_id");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':num', $num);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':role', $role);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Update user error: " . $e->getMessage());
            return false;
        }
    }
}
?>
