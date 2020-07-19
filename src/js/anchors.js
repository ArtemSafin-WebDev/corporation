import jump from 'jump.js';

export default function() {
    const anchors = Array.from(document.querySelectorAll('.js-anchor-link'));
    let jumpAnimating = false;
    const offset = -1 * document.querySelector('.page-header__row').offsetHeight;
    const windowHash = window.location.hash;
    window.location.hash = '';
    anchors.forEach(anchor => {
        anchor.addEventListener('click', event => {
            event.preventDefault();
            if (jumpAnimating) return;
            const hash = anchor.hash;
            const element = document.querySelector(hash);

            if (element) {
              
                jumpAnimating = true;
                jump(element, {
                    offset,
                    callback: () => {
                        jumpAnimating = false;
                    }
                });
            }
        });
    });

    window.addEventListener('load', function() {
        if (windowHash) {
            const elementToScroll = document.querySelector(windowHash);
            if (elementToScroll) {
                event.preventDefault();
                if (jumpAnimating) return;

                jumpAnimating = true;
                jump(elementToScroll, {
                    offset,
                    callback: () => {
                        jumpAnimating = false;
                    }
                });
            }
        }
    });
}
