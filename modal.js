const loginFormBtn = document.querySelector('.login-form');
const registerFormBtn = document.querySelector('.register-form');
const loginForm = document.querySelector('.js-login-form');
const registerForm = document.querySelector('.js-register-form');
const closeBtns = document.querySelectorAll('.js-close');
const modal = document.querySelector('.js-modal');
const modalContainer = document.querySelector('.js-modal-container');
const switchTos = document.querySelectorAll('.js-switch-to');

function closeForm() {
    modal.classList.remove('open');
    loginForm.classList.remove('hidden');
    registerForm.classList.remove('hidden');
}

function openLogin() {
    modal.classList.add('open');
    registerForm.classList.add('hidden');
}

function openRegister() {
    modal.classList.add('open');
    loginForm.classList.add('hidden');
}
function switchToForm() {
    loginForm.classList.toggle('hidden');
    registerForm.classList.toggle('hidden');
}

loginFormBtn.addEventListener('click', openLogin);
registerFormBtn.addEventListener('click', openRegister);
for(const switchTo of switchTos) {
    switchTo.addEventListener('click', switchToForm);
}
for(const closeBtn of closeBtns) {
    closeBtn.addEventListener('click', closeForm);
}

modalContainer.addEventListener('click', function(e) {
    if(e.target === modalContainer) {
        closeForm();
    }
});