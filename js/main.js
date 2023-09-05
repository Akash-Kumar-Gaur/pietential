function getElementById(id){
  return document.getElementById(id)
}
function getElement(className){
  return document.querySelector(className)
}
function getElements(classNames){
  return document.querySelectorAll(classNames)
}
let slider = document.querySelector(".sliderWrapperMain");
let inner = document.querySelector(".sliderWrapper");

let sliderImage = document.querySelectorAll(".swiper-slide");

var sliderC = new Swiper(".cvSwiper", {
  loop: true,
  loopedSlides: 7,
  centeredSlides: true,
  slideToClickedSlide: true,
  autoplay: {
    delay: 7000,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  breakpoints: {
    0: {
      loopedSlides: 1,
    },
    225: {
      loopedSlides: 2,
    },
    575: {
      loopedSlides: 3,
    },
    767: {
      loopedSlides: 4,
    },
    992: {
      loopedSlides: 5,
    },
  },
});

var swiper = new Swiper(".mySwiper", {
  slidesPerView: 5,
  spaceBetween: 50,
  centeredSlides: true,
  slideToClickedSlide: true,
  autoplay: {
    delay: 7000,
  },
  loop: true,
  breakpoints: {
    0: {
      slidesPerView: 3,
      spaceBetween: 20,
    },
    480: {
      slidesPerView: 3,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 4,
      spaceBetween: 40,
    },
    1024: {
      slidesPerView: 5,
      spaceBetween: 50,
    },
  },
});
var swiperProcessBelow = new Swiper(".modal-slider", {
  slidesPerView: 4,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {
    0: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 3,
      spaceBetween: 40,
    },
    1024: {
      slidesPerView: 3,
      spaceBetween: 40,
    },
  },
});
var swiperProcess = new Swiper(".processSwiper", {
  spaceBetween: 30,
  centeredSlides: true,
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

swiper.controller.control = sliderC;
sliderC.controller.control = swiper;

// for lazy loading
document.addEventListener("DOMContentLoaded", function () {
  var lazyImages = document.querySelectorAll(".lazy");
  var lazyLoad = function (target) {
    var io = new IntersectionObserver(function (entries, observer) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          var img = entry.target;
          img.setAttribute("src", img.getAttribute("data-src"));
          img.classList.remove("lazy");
          observer.disconnect();
        }
      });
    });
    io.observe(target);
  };
  lazyImages.forEach(lazyLoad);
});

var swiper = Swiper;
var init = false;
function swiperMode() {
  let mobile = window.matchMedia("(min-width: 0px) and (max-width: 767px)");
  if (mobile.matches) {
    if (!init) {
      init = true;
      swiper = new Swiper(".slider-cards-js", {
        slidesPerView: 1,
        centeredSlides: true,
        spaceBetween: 32,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });
    }
  } else {
    swiper.destroy();
    init = false;
  }
}
window.addEventListener("load", function () {
  swiperMode();
});
window.addEventListener("resize", function () {
  swiperMode();
});

var swiper = new Swiper(".modal-slider", {
  slidesPerView: 4,
  slideToClickedSlide: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {
    0: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 3,
      spaceBetween: 40,
    },
    1024: {
      slidesPerView: 3,
      spaceBetween: 40,
    },
  },
});

function onListClick(className, index) {
  let tabContent = document.querySelectorAll(".howWeDo");
  for (i = 0; i < tabContent.length; i++) {
    tabContent[i].style.display = "none";
  }
  tabButton = document.getElementsByClassName("tabButton");
  for (i = 0; i < tabButton.length; i++) {
    tabButton[i].className = tabButton[i].className.replace(" active", "");
  }
  document.getElementById(className).style.display = "block";
}

