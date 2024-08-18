<?php 
include "header.php";
include "slider.php";
include_once __DIR__ . '/../user/user.php';
include_once __DIR__ . '/../user/connectdb.php'; // Thêm dòng này để kết nối CSDL

$user = new User($pdo); // Truyền đối tượng PDO vào đây
$show_users = $user->getAllUsers(); 
?>

<div class="admin-content-right">
    <div class="admin-content-right-account_list">
        <h1>Danh sách tài khoản</h1>
        <table>
            <tr>
                <th>STT</th>
                <th>User ID</th>
                <th>Tên người dùng</th>
                <th>Email</th>
                <th>Password</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Vai trò</th>
                <th>Thao tác</th>
            </tr>
            <?php 
            if($show_users){
                $i = 0;
                while($result = $show_users->fetch(PDO::FETCH_ASSOC)){ 
                    $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $result['user_id']; ?></td>
                <td><?php echo $result['name']; ?></td>
                <td><?php echo $result['email']; ?></td>
                <td><?php echo $result['pass']; ?></td>
                <td><?php echo $result['num']; ?></td>
                <td><?php echo $result['address']; ?></td>
                <td><?php echo $result['role']; ?></td>
                <td>
                    <a href="accountedit.php?user_id=<?php echo $result['user_id']; ?>">Sửa</a> | 
                    <a href="accountdelete.php?user_id=<?php echo $result['user_id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này không?')">Xóa</a>
                </td>
            </tr>
            <?php 
                }
            }
            ?>
        </table>
    </div>
</div>
</section>
</body>
</html>
