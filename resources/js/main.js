import Swiper from 'swiper';
import { Navigation,  EffectCoverflow, Pagination, Autoplay, Parallax } from 'swiper/modules';

import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/effect-coverflow';
import 'swiper/css/pagination';


const animatedSliderEl = document.querySelector(".animated-slider");
if (animatedSliderEl) {
  new Swiper(animatedSliderEl, {
    modules: [EffectCoverflow, Autoplay],
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: "auto",
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
    loop: true,
    coverflowEffect: {
      rotate: 50,
      stretch: 0,
      depth: 100,
      modifier: 1,
      slideShadows: true,
    },
    pagination: {
      el: ".swiper-pagination",
    },
  });
}

const tripleSection = document.querySelector(".carpe-triple-slider-sec");
const tripleSliderEl = tripleSection?.querySelector(".cd-triple-swiper");
const triplePrev = tripleSection?.querySelector(".cd-triple-swiper-nav--prev");
const tripleNext = tripleSection?.querySelector(".cd-triple-swiper-nav--next");
if (tripleSliderEl && triplePrev && tripleNext) {
  new Swiper(tripleSliderEl, {
    modules: [Autoplay, Navigation],
    slidesPerView: 3,
    spaceBetween: 0,
    loop: true,
    speed: 900,
    grabCursor: true,
    // autoplay: {
    //   delay: 3200,
    //   disableOnInteraction: false,
    // },
    navigation: {
      prevEl: triplePrev,
      nextEl: tripleNext,
    },
    breakpoints: {
      0: { slidesPerView: 1, spaceBetween: 0 },
      640: { slidesPerView: 2, spaceBetween: 0 },
      1024: { slidesPerView: 3, spaceBetween: 0 },
    },
  });
}
