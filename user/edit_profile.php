<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Chuyển hướng đến trang đăng nhập nếu chưa đăng nhập
    exit();
}

include_once 'connectdb.php'; // Bao gồm tệp cấu hình kết nối cơ sở dữ liệu
include_once 'user.php'; // Bao gồm tệp chứa các hàm xử lý người dùng

// Tạo thể hiện của lớp User và lấy thông tin người dùng
$user = new User();
$userId = $_SESSION['user_id'];
$userInfo = $user->get_user_by_id($userId);

if (!$userInfo) {
    echo "Không tìm thấy thông tin người dùng.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Xử lý form khi gửi
    $name = trim($_POST['name']);
    $number = trim($_POST['number']);
    $address = trim($_POST['address']);
    $avatar = $_FILES['art'] ?? null;

    // Kiểm tra dữ liệu đầu vào
    if (empty($name) || empty($number) || empty($address)) {
        $error = "Tất cả các trường đều bắt buộc.";
    } else {
        // Xử lý ảnh đại diện nếu có
        $avatarUrl = $userInfo['art']; // Giữ nguyên ảnh hiện tại nếu không có ảnh mới

        if ($avatar && $avatar['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../assets/img/avatar_defaut/'; // Thay đổi đường dẫn nếu cần

            // Kiểm tra xem thư mục uploads có tồn tại không, nếu không thì tạo mới
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Lấy tên tệp mà không có đường dẫn
            $fileName = basename($avatar['name']);
            $uploadFile = $uploadDir . $fileName;
            
            // Kiểm tra loại tệp
            $fileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($fileType, $allowedTypes)) {
                if (move_uploaded_file($avatar['tmp_name'], $uploadFile)) {
                    $avatarUrl = $fileName; // Chỉ lưu tên tệp vào cơ sở dữ liệu
                } else {
                    $error = "Đã xảy ra lỗi khi tải lên ảnh.";
                }
            } else {
                $error = "Loại tệp không hợp lệ. Chỉ chấp nhận jpg, jpeg, png, gif.";
            }
        }

        // Cập nhật thông tin người dùng
        $updateResult = $user->updateUser($userId, $name, $userInfo['email'], $number, $address, $userInfo['role'], $avatarUrl);

        if ($updateResult) {
            $success = "Thông tin đã được cập nhật thành công.";
        } else {
            $error = "Đã xảy ra lỗi trong quá trình cập nhật.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa thông tin cá nhân</title>
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.5.2-web/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/edit-pro.css">
    <style>
        .avatar-container {
            position: relative;
            width: 150px;
            height: 150px;
            margin-bottom: 20px;
        }

        .avatar-container img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            cursor: pointer;
            object-fit: cover;
            transition: opacity 0.3s ease;
        }

        .avatar-container img:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <main>
        <section class="edit-profile">
            <h1>Chỉnh sửa thông tin cá nhân</h1>

            <?php if (isset($success)): ?>
                <p class="success"><?php echo htmlspecialchars($success); ?></p>
            <?php elseif (isset($error)): ?>
                <p class="error"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <form action="edit_profile.php" method="post" enctype="multipart/form-data">
                <label for="art">Ảnh đại diện:</label>
                <div class="avatar-container">
                    <img id="avatarPreview" src="../assets/img/avatar_defaut/<?php echo htmlspecialchars($userInfo['art'] ?? 'default_avatar.jpg'); ?>" alt="Ảnh đại diện hiện tại">
                    <input type="file" id="art" name="art" style="display: none;">
                </div>
                
                <label for="name">Họ và tên:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($userInfo['name'] ?? ''); ?>" required>

                <label for="number">Số điện thoại:</label>
                <input type="text" id="number" name="number" value="<?php echo htmlspecialchars($userInfo['num'] ?? ''); ?>" required>

                <label for="address">Địa chỉ:</label>
                <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($userInfo['address'] ?? ''); ?>" required>

                <button type="submit" class="btn">Cập nhật thông tin</button>
            </form>
        </section>
    </main>

    <script>
        document.getElementById('avatarPreview').addEventListener('click', function() {
            document.getElementById('art').click();
        });

        document.getElementById('art').addEventListener('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                document.getElementById('avatarPreview').src = URL.createObjectURL(file);
            }
        });
    </script>
</body>
</html>
