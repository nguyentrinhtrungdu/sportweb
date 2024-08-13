<?php
include_once __DIR__ . '/connectdb.php'; // Bao gồm tệp kết nối cơ sở dữ liệu

class User {
    private $pdo;

    public function __construct() {
        global $pdo; // Sử dụng biến kết nối PDO từ tệp connectdb.php
        $this->pdo = $pdo;
    }

    // Đăng ký người dùng mới
    public function register($name, $password, $email) {
        $sql = "INSERT INTO users (name, pass, email, role) VALUES (:name, :password, :email, 'user')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':password', $password); // Không mã hóa mật khẩu
        $stmt->bindParam(':email', $email);

        return $stmt->execute();
    }

    // Lấy ID người dùng dựa trên email
    public function getUserId($email) {
        $sql = "SELECT user_id FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ? $user['user_id'] : null;
    }

    // Lấy vai trò của người dùng dựa trên email
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

    // Xử lý đăng nhập
    public function login($email, $password) {
        $sql = "SELECT pass FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && $password === $user['pass']) { // So sánh mật khẩu không mã hóa
            return true;
        }
        return false;
    }
}
?>
