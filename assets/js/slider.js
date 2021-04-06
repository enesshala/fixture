// QUOTES SLIDER
let quotes = [
    "Choose a better way to represent your app.",
    "Quality is more important than quantity.",
    "Quality is not an act, it is a habit.",
    "Be the change that you wish to see in the world.",
  ],
  curIndex = 0;
textDuration = 3000;

function slideShow() {
  let placeholder = document.getElementById("slider__text");

  placeholder.className += "fadeOut";
  setTimeout(function () {
    placeholder.innerHTML = quotes[curIndex];
    placeholder.className = "";
  }, 4500);
  curIndex++;
  if (curIndex == quotes.length) {
    curIndex = 0;
  }
  setTimeout(slideShow, textDuration);
}

slideShow();

// IMAGE SLIDER
let currentImage = 1;
changeImage(currentImage);

function plusSlides(n) {
  changeImage((currentImage += n));
}

function changeImage(n) {
  let slides = document.getElementsByClassName("slider__slide");
  if (n > slides.length) {
    currentImage = 1;
  }
  if (n < 1) {
    currentImage = slides.length;
  }

  for (let i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }

  slides[currentImage - 1].style.display = "block";
}

// Auto Slider
// let slideImages = [
//   "images/slider-img1.jpg",
//   "images/slider-img2.jpg",
//   "images/slider-img3.jpg",
//   "images/slider-img4.jpg",
//   "images/slider-img5.jpg",
// ];

// let autoImage = 1;

// window.setInterval(() => {
//   let slide = document.getElementById("slider__image");
//   switch (autoImage) {
//     case 0:
//       slide.setAttribute("src", slideImages[autoImage]);
//       break;
//     case 1:
//       slide.setAttribute("src", slideImages[autoImage]);
//       break;
//     case 2:
//       slide.setAttribute("src", slideImages[autoImage]);
//       break;
//     case 3:
//       slide.setAttribute("src", slideImages[autoImage]);
//       break;
//     case 4:
//       slide.setAttribute("src", slideImages[autoImage]);
//       break;
//   }

//   autoImage++;

//   if (autoImage === slideImages.length) {
//     autoImage = 0;
//   }
// }, 7000);
