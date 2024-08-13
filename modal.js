document.addEventListener('DOMContentLoaded', function () {
    const modal = document.querySelector('.js-modal');
    const openRegisterBtn = document.querySelector('.register-form');
    const openLoginBtn = document.querySelector('.login-form');
    const closeButtons = document.querySelectorAll('.js-close');
    const switchToRegisterBtn = document.querySelectorAll('.js-switch-to')[0]; // Switch to Register from Login
    const switchToLoginBtn = document.querySelectorAll('.js-switch-to')[1]; // Switch to Login from Register

    function openModal() {
        modal.classList.add('open');
    }

    function closeModal() {
        modal.classList.remove('open');
    }

    function switchToRegisterForm() {
        document.querySelector('.js-register-form').classList.add('active');
        document.querySelector('.js-login-form').classList.remove('active');
    }

    function switchToLoginForm() {
        document.querySelector('.js-login-form').classList.add('active');
        document.querySelector('.js-register-form').classList.remove('active');
    }

    // Event listeners for opening modals
    openRegisterBtn.addEventListener('click', function () {
        openModal();
        switchToRegisterForm();
    });

    openLoginBtn.addEventListener('click', function () {
        openModal();
        switchToLoginForm();
    });

    // Event listeners for closing modals
    closeButtons.forEach(button => {
        button.addEventListener('click', closeModal);
    });

    // Event listeners for switching forms
    switchToRegisterBtn.addEventListener('click', switchToRegisterForm);
    switchToLoginBtn.addEventListener('click', switchToLoginForm);

    // Close modal when clicking outside of modal body
    modal.addEventListener('click', function (e) {
        if (e.target === modal) {
            closeModal();
        }
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const switchToLogin = document.querySelectorAll('.js-switch-to');
    const registerForm = document.querySelector('.js-register-form');
    const loginForm = document.querySelector('.js-login-form');

    switchToLogin.forEach(button => {
        button.addEventListener('click', function() {
            registerForm.classList.toggle('active');
            loginForm.classList.toggle('active');
        });
    });

    const closeModal = document.querySelectorAll('.js-close');
    closeModal.forEach(button => {
        button.addEventListener('click', function() {
            document.querySelector('.js-modal').style.display = 'none';
        });
    });
});
