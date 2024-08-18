const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});
document.addEventListener('DOMContentLoaded', function() {
    const switchToLogin = document.querySelectorAll('.js-switch-to');
    const registerForm = document.querySelector('.js-register-form');
    const loginForm = document.querySelector('.js-login-form');

loginBtn.addEventListener('click', () => {
    container.classList.remove("active")});

});
Validator({
    form: '#sign-up-form',
    formGroupSelector: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#name', 'Vui lòng nhập họ và tên'),
        Validator.isEmail('#email', 'Trường này phải là email'),
        
        Validator.isEmail('#email', 'Trường này phải là email'),
        Validator.minLength('#password', 6, 'Mật khẩu phải có ít nhất 6 ký tự'),
        Validator.isRequired('#password_confirmation', 'Vui lòng nhập lại mật khẩu'),
        Validator.isConfirmed('#password_confirmation', function () {
            return document.querySelector('#sign-up-form #password').value;
        }, 'Mật khẩu xác nhận không khớp')
    ],
    onSubmit: function (data) {
        // Nếu form hợp lệ, gửi form đến regis.php
        document.getElementById('sign-up-form').submit();
    }
});

  document.addEventListener('DOMContentLoaded', function () {
    const emailInput = document.querySelector('#email');
    const emailMessage = emailInput.nextElementSibling;

    emailInput.addEventListener('input', function () {
        const email = emailInput.value;

        if (email) {
            fetch('check_email.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    'email': email
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'exists') {
                    emailMessage.textContent = data.message;
                    emailMessage.style.color = 'red';
                } else if (data.status === 'valid') {
                    emailMessage.textContent = data.message;
                    emailMessage.style.color = 'red';
                }
            })
            .catch(error => console.error('Error:', error));
        } else {
            emailMessage.textContent = '';
        }
    });
});
// 
document.addEventListener('DOMContentLoaded', function () {
    const emailInput = document.querySelector('#email');
    const emailMessage = emailInput.nextElementSibling;
    let isEmailValid = false;

    emailInput.addEventListener('input', async function () {
        const email = emailInput.value;

        if (email) {
            try {
                const response = await fetch('./user/check_email.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({ 'email': email })
                });
                const data = await response.json();
                
                if (data.status === 'exists') {
                    emailMessage.textContent = data.message;
                    emailMessage.style.color = 'red';
                    isEmailValid = false;
                } else if (data.status === 'valid') {
                    emailMessage.textContent = data.message;
                    emailMessage.style.color = 'green';
                    isEmailValid = true;
                }
            } catch (error) {
                console.error('Error:', error);
            }
        } else {
            emailMessage.textContent = '';
            isEmailValid = false;
        }
    });

    // Validator form đăng ký
    Validator({
        form: '#sign-up-form',
        formGroupSelector: '.form-group',
        errorSelector: '.form-message',
        rules: [
            Validator.isRequired('#fullname', 'Vui lòng nhập tên đầy đủ của bạn'),
            Validator.isRequired('#email', 'Vui lòng nhập email'),
            Validator.isEmail('#email', 'Trường này phải là email'),
            Validator.isRequired('#address', 'Vui lòng nhập địa chỉ của bạn'),
            Validator.minLength('#password', 6, 'Mật khẩu phải có ít nhất 6 ký tự'),
            Validator.isRequired('#password_confirmation', 'Vui lòng nhập lại mật khẩu'),
            Validator.isConfirmed('#password_confirmation', function () {
                return document.querySelector('#sign-up-form #password').value;
            }, 'Mật khẩu xác nhận không khớp')
        ],
        onSubmit: async function (data) {
            // Kiểm tra email trước khi gửi form
            const email = document.querySelector('#email').value;
            
            try {
                const response = await fetch('./user/check_email.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({ 'email': email })
                });
                const result = await response.json();
                
                if (result.status === 'exists') {
                    alert('Email đã tồn tại, không thể đăng ký.');
                } else if (isEmailValid) {
                    document.getElementById('sign-up-form').submit();
                } else {
                    alert('Vui lòng kiểm tra lại email và thông tin đăng ký.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Đã xảy ra lỗi, vui lòng thử lại.');
            }
        }
    });
});
// 
