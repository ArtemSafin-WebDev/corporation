export default function() {
    const blocksToAnimate = Array.from(document.querySelectorAll('.invest-institutes__card'));

    const options = {
        rootMargin: '150px 0px 0px 0px'
    };

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
            }
        });
    }, options);

    blocksToAnimate.forEach(block => {
        observer.observe(block);
    });
}
