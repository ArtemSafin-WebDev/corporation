export default function() {
    var pageHeader = document.querySelector('.page-header');

    if (!pageHeader) return;

    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 0) {
            pageHeader.classList.add('filled');
        } else {
            pageHeader.classList.remove('filled');
        }
    });

    const scrollDownBtn = document.querySelector('.js-scroll-down');

    if (scrollDownBtn) {
        scrollDownBtn.addEventListener('click', event => {
            event.preventDefault();
            window.scrollBy({
                top: window.innerHeight,
                behavior: 'smooth'
            });
        });
    }

   
}
