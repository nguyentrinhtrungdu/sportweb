<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/modal.css">
    <title>Modern Login Page | AsmrProg</title>
</head>

<body>
    <div id="toast"></div>

    <div class="container" id="container">
        <!-- Sign Up Form -->
        <div class="form-container sign-up">
    <form id="sign-up-form" method="POST" action="./user/regis.php">
        <h1>Tạo Tài Khoản</h1>
        <div class="social-icons">
            <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
            <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
            <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
        </div>
        <span>hoặc sử dụng email của bạn để đăng ký</span>
    
        <div class="form-group">
            <input id="fullname" name="name" type="text" placeholder="Nhập họ và tên" class="form-control">
            <span class="form-message"></span>
        </div>
        <div class="form-group">
            <input id="email" name="email" type="email" placeholder="Nhập Email" class="form-control">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <input id="address" name="address" type="address" placeholder="Nhập địa chỉ" class="form-control">
            <span class="form-message"></span>
        </div>
        <div class="form-group">
            <input id="num" name="num" type="text" placeholder="Nhập số điện thoại" class="form-control">
            <span class="form-message"></span>
        </div>
        <div class="form-group">
            <input id="password" name="password" type="password" placeholder="Nhập mật khẩu" class="form-control">
            <span class="form-message"></span>
        </div>
        <div class="form-group">
            <input id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu" type="password" class="form-control">
            <span class="form-message"></span>
        </div>
        <button type="submit">Đăng Ký</button>
    </form>
</div>

        <!-- Sign In Form -->
        <div class="form-container sign-in">
    <form id="sign-in-form" method="POST" action="./user/login.php">
        <h1>Đăng nhập</h1>
        <div class="social-icons">
            <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
            <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
            <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
        </div>
        <span>hoặc sử dụng tài khoản của bạn</span>
        <div class="form-group">
            <input id="email" name="email" type="email" placeholder="Nhập email" class="form-control">
            <span class="form-message"></span>
        </div>
        <div class="form-group">
            <input id="login_password" name="login_password" type="password" placeholder="Nhập mật khẩu" class="form-control">
            <span class="form-message"></span>
        </div>
        <a href="#">Quên mật khẩu?</a>

        <button type="submit">Đăng nhập</button>
    </form>
</div>

        <!-- Toggle Container -->
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Chào Mừng Trở Lại!</h1>
                    <p>Nhập thông tin cá nhân của bạn để sử dụng tất cả các tính năng của trang web</p>
                    <button class="hidden" id="login">Đăng nhập</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Xin Chào Bạn!</h1>
                    <p>Đăng ký với thông tin cá nhân của bạn để sử dụng tất cả các tính năng của trang web</p>
                    <button class="hidden" id="register">Đăng ký</button>
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="./validator.js"></script>
    <script src="./modal.js"></script>
    <script src="./toast.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Validator({
                form: '#sign-up-form',
                formGroupSelector: '.form-group',
                errorSelector: '.form-message',
                rules: [
                   
                    Validator.isRequired('#fullname', 'Vui lòng nhập tên đầy đủ của bạn'),
                    Validator.isRequired('#username', 'Vui lòng nhập tên tài khoản'),
                    Validator.isRequired('#email', 'Vui lòng nhập email'),
                    Validator.isEmail('#email', 'Trường này phải là email'),
                    Validator.isRequired('#address', 'Vui lòng nhập địa chỉ của bạn'),
                    Validator.minLength('#password', 6, 'Mật khẩu phải có ít nhất 6 ký tự'),
                    Validator.isRequired('#password_confirmation', 'Vui lòng nhập lại mật khẩu'),
                    Validator.isConfirmed('#password_confirmation', function () {
                        return document.querySelector('#sign-up-form #password').value;
                    }, 'Mật khẩu xác nhận không khớp')
                ],
              
            });
            Validator({ 
                form: '#sign-in-form',
                formGroupSelector: '.form-group',
                errorSelector: '.form-message',
                rules: [
                    Validator.isRequired('#email', 'Vui lòng nhập tên tài khoản'),
                    Validator.isEmail('#email', 'Trường này phải là email'),
                    Validator.isRequired('#login_password', 'Vui lòng nhập mật khẩu'),
                    Validator.minLength('#login_password', 6, 'Mật khẩu phải có ít nhất 6 ký tự'),
                ],
               
            });
        });
    </script>
</body>
        <script src="modal.js"></script>
</html>
