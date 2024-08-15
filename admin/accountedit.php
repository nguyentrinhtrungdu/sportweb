<?php
include "header.php";
include "slider.php";
include_once __DIR__ . '/../user/user.php';

$user = new User();

// Lấy `user_id` từ query string
if (isset($_GET['user_id']) && is_numeric($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $user_data = $user->get_user_by_id($user_id);

    if (!$user_data) {
        echo "<p>Không tìm thấy người dùng!</p>";
        exit();
    }
} else {
    echo "<p>ID người dùng không hợp lệ!</p>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $num = $_POST['num'];
    $address = $_POST['address'];
    $role = $_POST['role'];

    if ($user->updateUser($user_id, $name, $email,$pass, $num, $address, $role)) {
        header("Location: accountlist.php");
    } else {
        echo "<p>Có lỗi xảy ra khi cập nhật.</p>";
    }

    // Refresh dữ liệu người dùng sau khi cập nhật
    $user_data = $user->get_user_by_id($user_id);
}
?>

<div class="admin-content-right">
    <div class="admin-content-right-account_edit">
        <h1>Chỉnh sửa tài khoản</h1>
        <form action="" method="post">
            <label for="name">Tên người dùng:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user_data['name']); ?>" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user_data['email']); ?>" required>

            <label for="pass">Pass:</label>
            <input type="text" id="pass" name="pass" value="<?php echo htmlspecialchars($user_data['pass']); ?>" required>
            
            <label for="num">Số điện thoại:</label>
            <input type="text" id="num" name="num" value="<?php echo htmlspecialchars($user_data['num']); ?>" required>
            
            <label for="address">Địa chỉ:</label>
            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($user_data['address']); ?>" required>
            
            <label for="role">Vai trò:</label>
            <select id="role" name="role" required>
                <option value="user" <?php echo $user_data['role'] == 'user' ? 'selected' : ''; ?>>User</option>
                <option value="admin" <?php echo $user_data['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
            </select>

            <button type="submit">Lưu thay đổi</button>
        </form>
    </div>
</div>

</section>
</body>
</html>
