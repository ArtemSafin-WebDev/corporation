import Swiper from 'swiper';

export default function () {
    const areasSliders = Array.from(document.querySelectorAll('.js-areas-slider'));

    areasSliders.forEach((slider) => {
        const container = slider.querySelector('.swiper-container');

        new Swiper(container, {
            spaceBetween: 18,
           
            slidesPerView: 3,
            // slidesPerGroup: 3,
           
            watchOverflow: true,
            pagination: {
                el: slider.querySelector('.areas__slider-pagination'),
                type: 'bullets',
            },
        });
    });
}
