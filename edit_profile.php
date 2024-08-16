<?php
session_start();
include './user/connectdb.php';
include './user/user.php';

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    header("Location: ./modal.php");
    exit();
}

$userId = $_SESSION['user_id'];
$userObj = new User($pdo);

// Lấy email của người dùng
$email = $userObj->getEmailById($userId); // Đảm bảo rằng phương thức getEmailById đã được định nghĩa trong lớp User

// Khởi tạo biến lỗi và thành công
$errorMessage = '';
$successMessage = '';

// Xử lý khi người dùng gửi biểu mẫu
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $num = trim($_POST['num']);
    $address = trim($_POST['address']);
    $avatarUrl = $userObj->getArtByEmail($email); // Lấy ảnh hiện tại của người dùng

    // Xử lý ảnh đại diện
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['avatar']['tmp_name'];
        $fileName = $_FILES['avatar']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileExtension, $allowedExtensions)) {
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $uploadFileDir = './assets/img/avatar_defaut/';
            $destPath = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $avatarUrl = $newFileName;
            } else {
                $errorMessage = 'Không thể tải lên ảnh. Vui lòng thử lại.';
            }
        } else {
            $errorMessage = 'Định dạng tệp không hợp lệ. Vui lòng tải lên tệp JPG, JPEG, PNG hoặc GIF.';
        }
    }

    // Cập nhật thông tin người dùng
    if (empty($errorMessage)) {
        if ($userObj->updateUser($userId, $name, $num, $address, $userObj->getUserRole($email), $avatarUrl)) {
            // Cập nhật session sau khi cập nhật thành công
            $_SESSION['user_name'] = $name;
            $_SESSION['user_num'] = $num;
            $_SESSION['user_address'] = $address;
            $_SESSION['user_art'] = $avatarUrl;

            $successMessage = 'Thông tin đã được cập nhật thành công.';
        } else {
            $errorMessage = 'Đã xảy ra lỗi khi cập nhật thông tin.';
        }
    }
}

// Lấy thông tin người dùng để điền vào biểu mẫu
$user = $userObj->get_user_by_id($userId);
if (!$user) {
    echo "Không thể lấy thông tin người dùng.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/profile.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-6.5.2-web/css/all.min.css">
    <title>Chỉnh sửa Hồ Sơ</title>
 
</head>
<body>
<?php
        include("./header.php");
        ?>
    <div class="container">
    <h1>Chỉnh sửa Hồ Sơ</h1>

    <?php if (!empty($successMessage)): ?>
        <div class="message" style="color: green;"><?php echo htmlspecialchars($successMessage); ?></div>
    <?php endif; ?>

    <?php if (!empty($errorMessage)): ?>
        <div class="message" style="color: red;"><?php echo htmlspecialchars($errorMessage); ?></div>
    <?php endif; ?>

    <form action="edit_profile.php" method="post" enctype="multipart/form-data">
        <div class="form-container">
        <div class="form-group avatar-container">
            <label for="avatar-upload">
                <img id="avatar-preview" src="./assets/img/avatar_defaut/<?php echo htmlspecialchars($user['art']); ?>" alt="Avatar">
            </label>
            <input type="file" id="avatar-upload" name="avatar" accept="image/*">
        </div>
        <div class="div">
            <div class="form-group">
                <label for="name">Tên:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="num">Số điện thoại:</label>
                <input type="text" id="num" name="num" value="<?php echo htmlspecialchars($user['num']); ?>" required>
            </div>

            <div class="form-group">
                <label for="address">Địa chỉ:</label>
                <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($user['address']); ?>" required>
            </div>
        </div>
        </div>

        <div class="button-nav"><button type="submit">Cập nhật</button></div>
    </form>
      
    <div class="quaylai">
    <a href="#" id="back-link">Quay lại</a>
</div>


    <script>
        document.getElementById('avatar-upload').addEventListener('change', function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatar-preview').src = e.target.result;
            };
            reader.readAsDataURL(this.files[0]);
        });
        document.addEventListener('DOMContentLoaded', function() {
        // Lấy URL trang trước đó từ sessionStorage
        var previousPage = sessionStorage.getItem('previousPage');

        // Nếu URL tồn tại, cập nhật liên kết quay lại
        if (previousPage) {
            document.getElementById('back-link').href = previousPage;
        } else {
            // Nếu không có URL trước đó, quay về trang chính (hoặc trang mặc định)
            document.getElementById('back-link').href = 'index.php'; // Thay thế 'index.php' bằng trang mặc định của bạn
        }
    });
    </script>
</body>
</html>
