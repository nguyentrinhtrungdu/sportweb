<!-- Modal HTML -->
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
                <form action="../user/regis.php" method="post">
                    <div class="auth-form__form">
                        <div class="auth-form__group">
                            <input type="text" class="auth-form__input" name="name" placeholder="Nhập tên của bạn" required>
                        </div>
                        <div class="auth-form__group">
                            <input id="email" type="email" class="auth-form__input" name="email" placeholder="Email của bạn" required>
                            <span id="emailError" class="auth-form__error" style="display: none;">Email đã tồn tại</span>
                        </div>
                        <div class="auth-form__group">
                            <input type="text" class="auth-form__input" name="address" placeholder="Nhập địa chỉ" required>
                        </div>
                        <div class="auth-form__group">
                            <input type="password" class="auth-form__input" name="pass" placeholder="Password của bạn" required>
                        </div>
                        <div class="auth-form__group">
                            <input type="password" class="auth-form__input" name="repass" placeholder="Nhập lại password" required>
                        </div>
                    </div>
                    <div class="auth-form__aside">
                        <p class="auth-form__policy-text">Bằng việc đăng ký, bạn đã đồng ý với Shopee về
                            <a href="" class="auth-form__text-link">Điều khoản dịch vụ</a> &
                            <a href="" class="auth-form__text-link">Chính sách bảo mật</a>
                        </p>
                    </div>
                    <div class="auth-form__controls">
                        <button class="btn btn--normal auth-form__controls-back js-close">TRỞ LẠI</button>
                        <button class="btn btn--primary" type="submit" name="dangky" value="Đăng ký">ĐĂNG KÝ</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Login form -->
        <div class="auth-form js-login-form">
            <div class="auth__form-container">
                <div class="auth-form__header">
                    <h3 class="auth-form__heading">Đăng nhập</h3>
                    <span class="auth-form__switch-btn js-switch-to">Đăng ký</span>
                </div>
                <form action="../user/login.php" method="post">
                    <div class="auth-form__form">
                        <div class="auth-form__group">
                            <input type="text" class="auth-form__input" placeholder="Email của bạn" name="email" id="" required>
                        </div>
                        <div class="auth-form__group">
                            <input type="password" class="auth-form__input" placeholder="Password của bạn" name="pass" id="" required>
                        </div>
                    </div>
                    <div class="auth-form__controls">
                        <button class="btn btn--primary" type="submit" name="dangnhap" value="Đăng nhập">ĐĂNG NHẬP</button>
                        <button class="btn btn--normal auth-form__controls-back js-close">TRỞ LẠI</button>
                    </div>
                    <?php if (isset($txt_erro) && $txt_erro != ""): ?>
                        <p class="auth-form__error"><?php echo htmlspecialchars($txt_erro); ?></p>
                    <?php endif; ?>
                </form>
                <div class="auth-form__aside">
                    <div class="auth-form__help">
                        <a href="" class="auth-form__help-link auth-form__help-forgot">Quên mật khẩu</a>
                        <span class="auth-form__help-separate"></span>
                        <a href="" class="auth-form__help-link">Cần trợ giúp</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="modal.js"></script>
