export default function() {
    const regionMaps = Array.from(document.querySelectorAll('.js-region-map'));

    regionMaps.forEach(mapElement => {
        const btns = Array.from(mapElement.querySelectorAll('.region-map__button'));
        const mapItems = Array.from(mapElement.querySelectorAll('.region-map__item'));
        const regionMapLayers = Array.from(mapElement.querySelectorAll('.region-map__orenburg-map-layer'));
        const layerCheckboxes = Array.from(mapElement.querySelectorAll('.region-map__orenburg-map-filters-checkbox-input'));
        const zoom = mapElement.querySelector('.region-map__zoom');

        function changeMap(index) {
            mapItems.forEach((item, itemIndex) => {
                if (itemIndex === index) {
                    item.classList.add('active');
                } else {
                    item.classList.remove('active');
                }
            });
            btns.forEach((item, itemIndex) => {
                if (itemIndex === index) {
                    item.classList.add('active');
                } else {
                    item.classList.remove('active');
                }
            });
        }

        function toggleMapLayer(layerName) {
            const layer = regionMapLayers.find(element => element.getAttribute('data-layer') === layerName);

            if (layer !== -1) {
                layer.classList.toggle('hidden');
            }
        }

        btns.forEach((btn, btnIndex) =>
            btn.addEventListener('click', event => {
                event.preventDefault();
                changeMap(btnIndex);
            })
        );


        layerCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                const name = checkbox.hasAttribute('name') && checkbox.getAttribute('name');
                if (name) {
                    toggleMapLayer(name);
                }
            })
        })

        zoom.addEventListener('click', function(event) {
            event.preventDefault();
            changeMap(1);
        })

        changeMap(0);
    });
}
