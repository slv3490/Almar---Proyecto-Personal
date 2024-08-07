import Swiper from 'swiper';
import { Navigation } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';

if(document.querySelector(".swiper")) {
    new Swiper(".mySwiper", {
        modules: [Navigation],
        slidesPerView: 4,
        spaceBetween: 30,
        freeMode: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
}