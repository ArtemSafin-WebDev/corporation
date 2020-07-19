import Swiper from 'swiper';

export default function() {
    const newsSliders = Array.from(document.querySelectorAll('.js-news-slider'));
    newsSliders.forEach(slider => {
        const container = slider.querySelector('.swiper-container');
        console.log('Initializing swiper');
        new Swiper(container, {
            slidesPerView: 'auto',
            watchOverflow: true,
            spaceBetween: 16,
            navigation: {
                nextEl: slider.querySelector('.news-slider__arrow-btn--next'),
                prevEl: slider.querySelector('.news-slider__arrow-btn--prev')
            },
            breakpoints: {
               
                568: {
                    slidesPerView: 4,
                    spaceBetween: 16,
                }
            }
        });
    });
}
