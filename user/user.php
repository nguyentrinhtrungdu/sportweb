<?php
include_once __DIR__ . '/connectdb.php'; // Bao gồm tệp kết nối cơ sở dữ liệu

class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Đăng ký người dùng mới
    public function register($name, $password, $email, $address, $num) {
        try {
            $defaultAvatarUrl = 'av.jpg'; // URL của ảnh đại diện mặc định

            $sql = "INSERT INTO users (pass, email, role, name, num, address, art) VALUES (:password, :email, 'user', :name, :num, :address, :art)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':password', $password); // Lưu trữ mật khẩu dưới dạng văn bản thuần túy
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':num', $num);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':art', $defaultAvatarUrl);

            if ($stmt->execute()) {
                return true;
            } else {
                error_log("Lỗi cơ sở dữ liệu: " . print_r($stmt->errorInfo(), true));
                return false;
            }
        } catch (PDOException $e) {
            error_log("Lỗi PDO: " . $e->getMessage());
            return false;
        }
    }

    // Xử lý đăng nhập
    public function login($email, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && $password === $user['pass']) { // So sánh mật khẩu gốc
            return true;
        }
        return false;
    }

    // Lấy ID người dùng từ email
    public function getUserId($email) {
        $sql = "SELECT user_id FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ? $user['user_id'] : null;
    }

    // Lấy email người dùng từ ID
    public function getEmailById($userId) {
        $sql = "SELECT email FROM users WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ? $user['email'] : null;
    }

    // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu chưa
    public function emailExists($email) {
        $sql = "SELECT 1 FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetchColumn() !== false; // Trả về true nếu tồn tại, false nếu không
    }

    // Lấy vai trò người dùng từ email
    public function getUserRole($email) {
        $sql = "SELECT role FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ? $user['role'] : null;
    }

    // Lấy tên người dùng từ email
    public function getUsernameByEmail($email) {
        $sql = "SELECT name FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ? $user['name'] : null;
    }

    // Lấy ảnh đại diện từ email
    public function getArtByEmail($email) {
        $sql = "SELECT art FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ? $user['art'] : null;
    }

    // Lấy thông tin người dùng theo ID
    public function get_user_by_id($user_id) {
        $query = "SELECT * FROM users WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    }

    // Lấy tất cả người dùng
    public function getAllUsers() {
        $sql = "SELECT * FROM users";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt;
    }

    // Xóa tài khoản người dùng
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

    // Cập nhật thông tin người dùng
    public function updateUser($user_id, $name, $num, $address, $role, $avatarUrl = null) {
        try {
            // Xây dựng câu lệnh SQL để cập nhật thông tin người dùng
            $sql = "UPDATE users SET name = :name, num = :num, address = :address, role = :role";
            if ($avatarUrl) {
                $sql .= ", art = :art";
            }
            $sql .= " WHERE user_id = :user_id";
    
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':num', $num);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':role', $role);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    
            if ($avatarUrl) {
                $stmt->bindParam(':art', $avatarUrl);
            }
    
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Lỗi cập nhật người dùng: " . $e->getMessage());
            return false;
        }
    }
    
    // Cập nhật avatar người dùng
    public function updateAvatar($user_id, $avatarUrl) {
        try {
            $stmt = $this->pdo->prepare("UPDATE users SET art = :art WHERE user_id = :user_id");
            $stmt->bindParam(':art', $avatarUrl);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Lỗi cập nhật ảnh đại diện: " . $e->getMessage());
            return false;
        }
    }
}
?>
