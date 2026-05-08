import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay, Parallax } from 'swiper/modules';

import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';


var swiper = new Swiper(".carpe-diem-banner-slider", {
    modules: [Autoplay, Parallax],
    speed: 600,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    loop: true,
    parallax: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });