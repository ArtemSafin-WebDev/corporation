// import { ScrollTrigger } from "gsap/ScrollTrigger";


let animating = false;

function openAccordeon(element) {
    element.style.maxHeight = 'none';
    const computedStyle = getComputedStyle(element);
    const computedHeight = computedStyle.height;
    element.style.maxHeight = '';
    animating = true;
    element && element.scrollTop;

    const transitionEndHandler = () => {
        console.log('Tranisitionnd Initiated');
        element.style.maxHeight = 'none';
        animating = false;
        element.removeEventListener('transitionend', transitionEndHandler);
        // ScrollTrigger.refresh(true);
    };
    element.addEventListener('transitionend', transitionEndHandler);
    element.style.maxHeight = `${computedHeight}`;
}

function closeAccordeon(element) {
    const computedStyle = getComputedStyle(element);
    const computedHeight = computedStyle.height;
    element.style.maxHeight = `${computedHeight}`;

    element && element.scrollTop;

    element.style.maxHeight = '';

    // ScrollTrigger.refresh(true);
}

export default function(accordionElements) {
    const accordionInstances = [];
    let initialized = false;
   
    function init() {
        accordionElements.forEach(element => {
            const btn = element.querySelector('.js-accordion-btn');
            const content = element.querySelector('.js-accordion-content');

            const handler = function(event) {
                event.preventDefault();
                if (animating) return;
                if (event.relatedTarget) {
                    event.relatedTarget.focus();
                } else {
                    event.currentTarget.blur();
                }
                
            
                if (!element.classList.contains('active')) {
                    accordionInstances.forEach(acc => {
                        closeAccordeon(acc.content);
                    });
                    accordionElements.forEach(element => element.classList.remove('active'));
                    openAccordeon(content);
                    element.classList.add('active');
                } else {
                    closeAccordeon(content);
                    element.classList.remove('active');
                }
            }
           

            btn.addEventListener('click', handler);


            accordionInstances.push({
                btn,
                content,
                handler,
                element
            });
        });

        initialized = true;
    }

    function destroy() {
        accordionInstances.forEach(instance => {
            instance.btn.removeEventListener('click', instance.handler)
        })
        accordionInstances = [];
        initialized = false;
    }


    function getInstances() {
        return accordionInstances;
    }

    function isInitailized() {
        return initialized;
    }

    return {
        init,
        destroy,
        isInitailized,
        getInstances
    };
}