import PerfectScrollbar from 'perfect-scrollbar';
import detectIt from 'detect-it';

export default function() {
    const regionEconomics = Array.from(document.querySelectorAll('.js-npa'));
    const innerScrollContainers = Array.from(document.querySelectorAll('.npa__item'));


    if (!detectIt.hasTouch && window.matchMedia("(min-width: 768px)").matches) {
        innerScrollContainers.forEach(container => {
            new PerfectScrollbar(container, {
                wheelSpeed: 2,
                wheelPropagation: true,
                minScrollbarLength: 80,
                suppressScrollX: true
            });
        });
    }
   
   

    regionEconomics.forEach(indicator => {
        const btns = Array.from(indicator.querySelectorAll('.npa__links-list-item > *:first-child'));
        const items = Array.from(indicator.querySelectorAll('.npa__item'));

        function changeTab(index) {
            btns.forEach((btn, btnIndex) => {
                if (btnIndex !== index) {
                    btn.classList.remove('active');
                } else {
                    btn.classList.add('active');
                }
            });

            items.forEach((item, itemIndex) => {
                if (itemIndex !== index) {
                    item.classList.remove('active');
                } else {
                    item.classList.add('active');
                }
            });

           
        }

        changeTab(0);

        btns.forEach((btn, btnIndex) =>
            btn.addEventListener('click', event => {
                event.preventDefault();
                changeTab(btnIndex);
            })
        );
    });
}
