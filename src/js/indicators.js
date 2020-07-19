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

export default function() {
    const indicators = Array.from(document.querySelectorAll('.js-indicators'));

    indicators.forEach(indicator => {
        const btns = Array.from(indicator.querySelectorAll('.indicators__nav-link'));
        const items = Array.from(indicator.querySelectorAll('.indicators__item'));

        

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

        btns.forEach(btn => {
            let btnAccordeonOpen = false;

            const nextSibling = btn.nextElementSibling;

            if (!nextSibling || !nextSibling.matches('ul')) return;

            btn.classList.add('has-deeper-level');
            btn.addEventListener('click', event => {
                event.preventDefault();

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
