import accordionFactory from './accordionFactory';

export default function() {
    const regionEconomics = Array.from(document.querySelectorAll('.js-region-economics'));

    if (window.matchMedia('(max-width: 767px)').matches) {
        regionEconomics.forEach(element => {
            const regionEconomicsNav = Array.from(element.querySelector('.region-economics__nav').children);
            const regionEconimicsItems = Array.from(element.querySelector('.region-economics__items').children);
            const regionEconomicsContent = element.querySelector('.region-economics__content');

            const accordionsContainer = document.createElement('div');
            accordionsContainer.className = 'region-economics__accordions';

            regionEconomicsContent.appendChild(accordionsContainer);
           

            regionEconomicsNav.forEach((navLink, navLinkIndex) => {
                
                const correspondingItem = regionEconimicsItems[navLinkIndex];
                // console.log(`Index ${navLinkIndex}`);
                // console.log('Item', correspondingItem)
                const card = correspondingItem.querySelector('.region-economics__item-card ');

                const accordionItem = document.createElement('div');
                accordionItem.className = 'region-economics__accordion-item';

                const accordionHiddenContent = document.createElement('div');

                accordionHiddenContent.className = 'region-economics__accordion-content';


                accordionHiddenContent.appendChild(card);
                

                navLink.classList.add('js-accordion-btn')
                accordionHiddenContent.classList.add('js-accordion-content');
                accordionItem.appendChild(navLink);
                accordionItem.appendChild(accordionHiddenContent)
                accordionsContainer.appendChild(accordionItem);

                correspondingItem.remove();
            });


            element.querySelector('.region-economics__nav').remove();
            element.querySelector('.region-economics__items').remove();


            const accordionItems = Array.from(element.querySelectorAll('.region-economics__accordion-item'));

            accordionFactory(accordionItems).init();

        })
        


    } else {
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
}
