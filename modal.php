<?php
session_start();
ob_start();
include "../sportweb/user/connectdb.php";
include "../sportweb/user/user.php";

if (isset($_POST['dangnhap']) && $_POST['dangnhap']) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $kq = getuserinfo($user, $pass);
    
    if ($kq) {
        $_SESSION['user_id'] = $kq[0]['id'];
        $_SESSION['username'] = $kq[0]['user'];
        $_SESSION['role'] = $kq[0]['role'];
        
        if ($kq[0]['role'] == 1) {
            // Admin user
            header('Location: ../admin/productlist.php');
        } else {
            // Regular user
            header('Location: index.php');
        }
    } else {
        // Handle login error
        $txt_erro = "Username or password is incorrect!";
    }
}
?>

<div class="modal js-modal">
        <div class="modal__overlay js-modal-container"></div>
        <div class="modal__body">
            
            <!-- Register form -->
            <div class="auth-form js-register-form">
                <div class="auth__form-container">
                    <div class="auth-form__header">
                        <h3 class="auth-form__heading">Đăng ký</h3>
                        <span class="auth-form__switch-btn js-switch-to">Đăng nhập</span>
                    </div>
                    <div class="auth-form__form">
                        <div class="auth-form__group">
                            <input type="text" class="auth-form__input" placeholder="Email của bạn">
                        </div>
                        <div class="auth-form__group">
                            <input type="password" class="auth-form__input" placeholder="Password của bạn">
                        </div>
                        <div class="auth-form__group">
                            <input type="password" class="auth-form__input" placeholder="Nhập lại password">
                        </div>
                    </div>
                    <div class="auth-form__aside">
                        <p class="auth-form__policy-text">Bằng việc đăng ký, bạn đã đồng ý với Shopee về
                            <a href="" class="auth-form__text-link">Điều khoản dịch vụ</a> &
                            <a href="" class="auth-form__text-link">Chính sách bảo mật</a>
                        </p>
                    </div>
                    <div class="auth-form__controls">
                        <button class="btn btn--normal auth-form__controls-back">TRỞ LẠI</button>
                        <button class="btn btn--primary">ĐĂNG KÝ</button>
                    </div>
                </div>
                <div class="auth-form__socials">
                    <a href="" class="auth-form__socials--fb btn btn--size-s btn--width-icon">
                        <i class="auth-form__socials-icon fa-brands fa-square-facebook"></i>
                        <span class="auth-form__socials-title">Kết nối với Facebook</span>
                    </a>
                    <a href="" class="auth-form__socials--gg btn btn--size-s btn--width-icon">
                        <i class="auth-form__socials-icon fa-brands fa-google"></i>
                        <span class="auth-form__socials-title">Kết nối với Google</span>
                    </a>
                </div>
            </div>
    
            <!-- Login form -->
            <div class="auth-form js-login-form">
                <div class="auth__form-container">
                    <div class="auth-form__header">
                        <h3 class="auth-form__heading">Đăng nhập</h3>
                        <span class="auth-form__switch-btn js-switch-to">Đăng ký</span>
                    </div>
                   
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <div class="auth-form__form">
                            <div class="auth-form__group">
                                <input type="text" class="auth-form__input" placeholder="Email của bạn" name="user" id="">
                            </div>
                            <div class="auth-form__group">
                                <input type="password" class="auth-form__input" placeholder="Password của bạn" name="pass" id="">
                            </div>
                        </div>
                        <div class="auth-form__controls">
                            <button class="btn btn--primary" type="submit" name="dangnhap" value="Đăng nhập">ĐĂNG NHẬP</button>
                            <button class="btn btn--normal auth-form__controls-back js-close">TRỞ LẠI</button>
                        </div>
                        <?php
                        if (isset($txt_erro) && $txt_erro != "") {
                            echo '<p class="auth-form__error">' . htmlspecialchars($txt_erro) . '</p>';
                        }
                        ?>
                    </form>

                    <div class="auth-form__aside">
                        <div class="auth-form__help">
                            <a href="" class="auth-form__help-link auth-form__help-forgot">Quên mật khẩu</a>
                            <span class="auth-form__help-separate"></span>
                            <a href="" class="auth-form__help-link">Cần trợ giúp</a>
                        </div>
                    </div>
                   
                </div>
                <div class="auth-form__socials">
                    <a href="" class="auth-form__socials--fb btn btn--size-s btn--width-icon">
                        <i class="auth-form__socials-icon fa-brands fa-square-facebook"></i>
                        <span class="auth-form__socials-title">Kết nối với Facebook</span>
                    </a>
                    <a href="" class="auth-form__socials--gg btn btn--size-s btn--width-icon">
                        <i class="auth-form__socials-icon fa-brands fa-google"></i>
                        <span class="auth-form__socials-title">Kết nối với Google</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="modal.js" ></script>