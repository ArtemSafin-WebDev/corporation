import PerfectScrollbar from 'perfect-scrollbar';

export default function() {
    const objectsLists = Array.from(document.querySelectorAll('.js-objects-list'));

    objectsLists.forEach(list => {
        const btns = Array.from(list.querySelectorAll('.areas__objects-nav-card'));
        const items = Array.from(list.querySelectorAll('.areas__objects-list-item'));
        const scrollContainers = Array.from(list.querySelectorAll('.areas__objects-nav'));

        scrollContainers.forEach(container => {
            new PerfectScrollbar(container, {
                wheelSpeed: 2,
                wheelPropagation: false,
                minScrollbarLength: 20
            });
        });

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
