import Swiper from 'swiper';

export default function() {
    const successSliders = Array.from(document.querySelectorAll('.js-success-slider'));

    successSliders.forEach(element => {
        const navSlideContainer = element.querySelector('.success-stories__nav-slider .swiper-container');
        const mainSliderContainer = element.querySelector('.success-stories__images-slider .swiper-container');
        const logosLinks = Array.from(element.querySelectorAll('.success-stories__logos-card'));
        const fractionPaginationElement = element.querySelector('.success-stories__nav-controls-fraction');

        function setFraction() {
            const totalSlides = this.slides.length;
            const currentSlide = this.realIndex + 1;

            fractionPaginationElement.textContent = `${currentSlide}/${totalSlides}`;
        }

        function setActiveNavLink(index) {
            logosLinks.forEach(link => link.classList.remove('active'));
            logosLinks[index].classList.add('active');
        }

        const mainSlider = new Swiper(mainSliderContainer, {
            watchOverflow: true,
            effect: 'fade',
            fadeEffect: {
                crossFade: false
            },
            navigation: {
                nextEl: element.querySelector('.success-stories__nav-controls-btn--next'),
                prevEl: element.querySelector('.success-stories__nav-controls-btn--prev')
            },
            pagination: {
                el: element.querySelector('.success-stories__nav-progress'),
                type: 'progressbar'
            },
            autoplay: {
                duration: 5000
            },
            on: {
                init: function() {
                    const self = this;
                    setFraction.call(self);
                    setActiveNavLink(self.activeIndex);
                },

                slideChange: function() {
                    const self = this;
                    setFraction.call(self);
                    setActiveNavLink(self.activeIndex);
                }
            }
        });

        const navSlider = new Swiper(navSlideContainer, {
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            autoHeight: false
        });

        mainSlider.controller.control = navSlider;
        navSlider.controller.control = mainSlider;

        logosLinks.forEach((link, linkIndex) => {
            link.addEventListener('click', event => {
                event.preventDefault();

                mainSlider.slideTo(linkIndex);
            });
        });
    });
}
