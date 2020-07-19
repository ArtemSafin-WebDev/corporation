import Swiper from 'swiper';



export default function() {
    const projectsSingleSliders = Array.from(document.querySelectorAll('.js-project-single-slider'));

    projectsSingleSliders.forEach(slider => {
        const container = slider.querySelector('.swiper-container');

        new Swiper(container, {
            watchOverflow: true,
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            navigation: {
                nextEl: slider.querySelector('.success-stories__nav-controls-btn--next'),
                prevEl: slider.querySelector('.success-stories__nav-controls-btn--prev')
            },
            pagination: {
                el: slider.querySelector('.success-stories__nav-controls-fraction'),
                type: 'fraction'
            },
        });
    });
}
