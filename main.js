let slideshow = document.getElementById('slideshow');
let slides = slideshow.getElementsByTagName('div');
let index = 0;

function nextSlide(){
    slides[index].classList.remove('active');
    index = (index + 1) % slides.length;
    slides[index].classList.add('active');
};
function prevSlide(){
    slides[index].classList.remove('active');
    index = (index - 1 + slides.length) % slides.length;
    slides[index].classList.add('active');
};

let slideshowText = document.getElementById('slideshowText');
let slidesText = slideshowText.getElementsByTagName('div');
let i = 0;

function nextSlideText(){
    slidesText[i].classList.remove('active');
    i = (i + 1) % slidesText.length;
    slidesText[i].classList.add('active');
};
function prevSlideText(){
    slidesText[i].classList.remove('active');
    i = (i - 1 + slidesText.length) % slidesText.length;
    slidesText[i].classList.add('active');
};

function menuToggle(){
    let nav = document.getElementById('navbar');
    nav.classList.toggle('active');
}

const menuHide = document.querySelector(".hideMenu");
menuHide.onclick = function () {
    menuToggle()
};
const menuHideSt = document.querySelector(".menuHideSt");
menuHideSt.onclick = function () {
    menuToggle()
};



