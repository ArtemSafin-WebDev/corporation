import Swiper from 'swiper';

export default function() {
    const stepsSliders = Array.from(document.querySelectorAll('.js-step-slider'));

    stepsSliders.forEach(slider => {
        const container = slider.querySelector('.swiper-container');
        const pagination = slider.querySelector('.schema__steps-slider-pagination-bullets');
        const steps = [];
        const prev = slider.querySelector('.schema__steps-btn--prev');
        const next = slider.querySelector('.schema__steps-btn--next');

        if (window.matchMedia('(max-width: 568px)').matches) {
        }
        const swiperInstance = new Swiper(container, {
            spaceBetween: 30,
            watchOverflow: true,
            navigation: {
                nextEl: next,
                prevEl: prev
            },
            autoHeight: false,
            init: false
        });

        swiperInstance.on('init', function() {
            const slidesCount = swiperInstance.slides.length;
            const currentIndex = swiperInstance.activeIndex;

            const stepElementTemplate = index => `   
            <svg width="60" height="16" aria-hidden="true" class="icon-step-arrow">
                <use xlink:href="#step-arrow" />
            </svg>   
            <span class="schema__steps-bullet-wrapper">
                <svg width="35" height="35" aria-hidden="true" class="icon-step">
                    <use xlink:href="#step" />
                </svg>
                <span class="schema__steps-bullet-text">
                    Шаг ${index + 1}
                </span>
            </span>
           
           
            `;

            for (let i = 0; i < slidesCount; i++) {
                const span = document.createElement('span');
                span.className = 'schema__steps-bullet';
                if (i === currentIndex) span.classList.add('schema__steps-bullet--active');
                span.innerHTML = stepElementTemplate(i);
                steps.push(span);
            }

            pagination.append(...steps);
        });

        swiperInstance.on('slideChange', function() {
            const currentIndex = swiperInstance.activeIndex;
            steps.forEach((step, index) => {
                step.classList.remove('schema__steps-bullet--active');
                if (index <= currentIndex) {
                    step.classList.add('schema__steps-bullet--active');
                }
            });
        });

        swiperInstance.init();

        steps.forEach((step, index) => {
            step.addEventListener('click', function() {
                swiperInstance.slideTo(index);
            });
        });
    });
}
