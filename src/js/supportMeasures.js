function openAccordeon(element) {
    element.style.maxHeight = 'none';
    const computedStyle = getComputedStyle(element);
    const computedHeight = computedStyle.height;
    element.style.maxHeight = '';
    setTimeout(() => {
        const transitionEndHandler = () => {
            console.log('Tranisitionnd Initiated');
            element.style.maxHeight = 'none';
            element.removeEventListener('transitionend', transitionEndHandler);
        };
        element.addEventListener('transitionend', transitionEndHandler);
        element.style.maxHeight = `${computedHeight}`;
    }, 20);
}

function closeAccordeon(element) {
    const computedStyle = getComputedStyle(element);
    const computedHeight = computedStyle.height;
    element.style.maxHeight = `${computedHeight}`;
    setTimeout(() => {
        element.style.maxHeight = '';
    }, 20);
}

import PerfectScrollbar from 'perfect-scrollbar';

export default function() {
    const indicators = Array.from(document.querySelectorAll('.js-support-measures'));

    indicators.forEach(indicator => {
        const btns = Array.from(indicator.querySelectorAll('.indicators__nav-link'));
        const items = Array.from(indicator.querySelectorAll('.indicators__item'));
        const scrollContainers = Array.from(indicator.querySelectorAll('.indicators__scroll-wrapper'));

        scrollContainers.forEach(container => {
            new PerfectScrollbar(container, {
                wheelSpeed: 2,
                wheelPropagation: true,
                minScrollbarLength: 20
            });
        });

        // function changeTab(index) {
        //     btns.forEach((btn, btnIndex) => {
        //         if (btnIndex !== index) {
        //             btn.classList.remove('active');
        //         } else {
        //             btn.classList.add('active');
        //         }
        //     });

        //     items.forEach((item, itemIndex) => {
        //         if (itemIndex !== index) {
        //             item.classList.remove('active');
        //         } else {
        //             item.classList.add('active');
        //         }
        //     });
        // }

        const initialCategory = btns[0].getAttribute('data-category');

        function changeTab(id) {
            btns.forEach(btn => {
                if (btn.getAttribute('data-category') !== id) {
                    btn.classList.remove('active');
                } else {
                    btn.classList.add('active');
                }
            });

            items.forEach(item => {
                if (item.getAttribute('data-category') !== id) {
                    item.classList.remove('active');
                } else {
                    item.classList.add('active');
                }
            });
        }

        changeTab(initialCategory);

        btns.forEach(btn =>
            btn.addEventListener('click', event => {
                event.preventDefault();
                changeTab(btn.getAttribute('data-category'));
            })
        );

        btns.forEach(btn => {
            let btnAccordeonOpen = false;

            const nextSibling = btn.nextElementSibling;

            if (!nextSibling || !nextSibling.matches('ul')) return;

            btn.classList.add('has-deeper-level');

            openAccordeon(nextSibling);
            btnAccordeonOpen = true;
            btn.classList.toggle('open');

            
            btn.addEventListener('click', event => {
                event.preventDefault();
                btn.classList.toggle('open');
                if (btnAccordeonOpen) {
                    closeAccordeon(nextSibling);
                    btnAccordeonOpen = false;
                    console.log('Closing accordeon');
                } else {
                    openAccordeon(nextSibling);
                    btnAccordeonOpen = true;
                    console.log('Opening accordeon');
                }
            });
        });
    });
}
