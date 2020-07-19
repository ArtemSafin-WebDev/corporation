import Swiper from 'swiper';

export default function() {
    const freeFromTaxes = Array.from(document.querySelectorAll('.js-free-from-taxes'));

    freeFromTaxes.forEach(element => {
        const navSliderContainer = element.querySelector('.free-from-taxes__slider-nav-slider .swiper-container');
        const mainSliderContainer = element.querySelector('.free-from-taxes__slider-main-slider .swiper-container');
        const fractionPaginationElement = element.querySelector('.free-from-taxes__slider-nav-fraction-pagination');
        console.log('FTX element', element);

        function setFraction() {
            const totalSlides = this.slides.length;
            const currentSlide = this.realIndex + 1;

            fractionPaginationElement.textContent = `${currentSlide}/${totalSlides}`;
        }

        const mainSliderInstance = new Swiper(mainSliderContainer, {
            effect: 'fade',
            watchOverflow: true,
            fadeEffect: {
                crossFade: false
            },
            navigation: {
                nextEl: element.querySelector('.free-from-taxes__slider-nav-btn--next'),
                prevEl: element.querySelector('.free-from-taxes__slider-nav-btn--prev')
            },
            pagination: {
                el: element.querySelector('.free-from-taxes__slider-nav-progress'),
                type: 'progressbar'
            },

            autoplay: {
                duration: 5000
            },
            on: {
                init: setFraction,
                slideChange: setFraction
            }
        });

        const navSliderInstance = new Swiper(navSliderContainer, {
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            autoHeight: true
        });

        mainSliderInstance.controller.control = navSliderInstance;
        navSliderInstance.controller.control = mainSliderInstance;
    });
}
