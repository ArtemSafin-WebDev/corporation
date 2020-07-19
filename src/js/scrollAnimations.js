import anime from 'animejs/lib/anime.es.js';

export default function() {
    const blocksToAnimate = Array.from(document.querySelectorAll('section'));

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

    const schemaCounters = Array.from(document.querySelectorAll('.schema__counter-amount'));

    schemaCounters.forEach(counter => {
        var data = {
            number: 0
        };

        anime({
            targets: data,
            number: parseInt(counter.textContent, 10),
            duration: 3000,
            round: 1,
            easing: 'linear',
            update: function() {
                counter.textContent = data.number;
            }
        });
    });
}
