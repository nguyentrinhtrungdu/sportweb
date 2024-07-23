let slideIndex = 0;
let autoSlideInterval;

function plusSlides(n) {
    clearInterval(autoSlideInterval);
    showSlides(slideIndex += n);
    autoSlideInterval = setInterval(() => { showSlides(slideIndex += 1); }, 3000);
}

function currentSlide(n) {
    clearInterval(autoSlideInterval);
    showSlides(slideIndex = n - 1);
    autoSlideInterval = setInterval(() => { showSlides(slideIndex += 1); }, 3000);
}

function showSlides(n) {
    let slides = document.getElementsByClassName("slide");
    let dots = document.getElementsByClassName("dot");
    if (n >= slides.length) {slideIndex = 0}
    if (n < 0) {slideIndex = slides.length - 1}
    for (let i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active-dot", "");
    }
    document.querySelector('.slides').style.transform = 'translateX(' + (-slideIndex * 100) + '%)';
    dots[slideIndex].className += " active-dot";
}

document.addEventListener('DOMContentLoaded', (event) => {
    showSlides(slideIndex);
    autoSlideInterval = setInterval(() => { showSlides(slideIndex += 1); }, 3000);
});