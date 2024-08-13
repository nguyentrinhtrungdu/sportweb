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
