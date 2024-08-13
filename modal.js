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
        Validator.isRequired('#email', 'Vui lòng nhập email'),
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
        const emailMessage = document.querySelector('#email-message');

        emailInput.addEventListener('input', function () {
            const email = emailInput.value;
            if (email) {
                fetch(`check_email.php?email=${encodeURIComponent(email)}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'error') {
                            emailMessage.textContent = data.message;
                            emailMessage.style.color = 'red';
                        } else {
                            emailMessage.textContent = data.message;
                            emailMessage.style.color = 'green';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            } else {
                emailMessage.textContent = '';
            }
        });
    });

