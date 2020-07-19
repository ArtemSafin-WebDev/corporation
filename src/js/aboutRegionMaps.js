export default function() {
    const maps = Array.from(document.querySelectorAll('.js-about-region-maps'));

    maps.forEach(map => {
        const items = Array.from(map.querySelectorAll('.about-regions__map'));
        const btns = Array.from(map.querySelectorAll('.about-regions__map-btn'));

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
