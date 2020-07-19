export default function() {
    const regionEconomics = Array.from(document.querySelectorAll('.js-region-economics'));

    regionEconomics.forEach(indicator => {
        const btns = Array.from(indicator.querySelectorAll('.region-economics__nav-link'));
        const items = Array.from(indicator.querySelectorAll('.region-economics__item'));

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
