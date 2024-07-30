const loginFormBtn = document.querySelector('.login-form');
const registerFormBtn = document.querySelector('.register-form');
const loginForm = document.querySelector('.js-login-form');
const registerForm = document.querySelector('.js-register-form');
const closeBtns = document.querySelectorAll('.js-close');
const modal = document.querySelector('.js-modal');
const modalContainer = document.querySelector('.js-modal-container');
const switchTos = document.querySelectorAll('.js-switch-to');
document.addEventListener('DOMContentLoaded', function() {
    var emailInput = document.getElementById('email');
    var emailError = document.getElementById('emailError');
    var registerForm = document.querySelector('.js-register-form');
    
    var emailExists = false;
    
    emailInput.addEventListener('input', function() {
        var email = this.value;

        if (email.length > 0) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', './user/check_email.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.exists) {
                        emailExists = true;
                        emailError.style.display = 'block';
                        emailError.textContent = response.message;
                    } else {
                        emailExists = false;
                        emailError.style.display = 'none';
                    }
                }
            };
            
            xhr.onerror = function() {
                console.error('Request failed');
            };
            
            xhr.send('email=' + encodeURIComponent(email));
        } else {
            emailError.style.display = 'none';
        }
    });

    registerForm.addEventListener('submit', function(event) {
        if (emailExists) {
            event.preventDefault(); // Ngăn không cho gửi form
            emailError.style.display = 'block';
            emailError.textContent = 'Email đã được sử dụng, vui lòng sử dụng email khác';
        }
    });
});




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