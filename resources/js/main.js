import Swiper from 'swiper';
import { Navigation,  EffectCoverflow, Pagination, Autoplay, Parallax } from 'swiper/modules';

import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/effect-coverflow';
import 'swiper/css/pagination';


var swiper = new Swiper(".animated-slider", {
    modules: [EffectCoverflow, Autoplay],
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: "auto",
    // auto play
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
