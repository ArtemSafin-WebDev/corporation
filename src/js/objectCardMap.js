import mapStyles from './data/mapStyles';
import regionBoundary from './data/region';

import Axios from 'axios';

export default function () {
    const objectsMaps = Array.from(document.querySelectorAll('.js-object-card-map'));

    const mapCenter = {
        lat: 52.0269262,
        lng: 54.7276647,
    };

    objectsMaps.forEach((map) => {
        let mapInstance = null;
        const mapElement = map.querySelector('.object-card__map');

        let districtsData = [];
        const districtsURL = map.hasAttribute('data-districts') ? map.getAttribute('data-districts') : '';
        console.log('Districts URL', districtsURL);

        async function updateObjects() {
            const coords = {
                lat: +map.getAttribute('data-lat'),
                lng: +map.getAttribute('data-lng'),
            };

            console.log('Object coords', coords);
            new google.maps.Marker({
                position: coords,
                map: mapInstance,
            });
        }

        async function initializeMap() {
            const coords = {
                lat: +map.getAttribute('data-lat'),
                lng: +map.getAttribute('data-lng'),
            };
            mapInstance = new google.maps.Map(mapElement, {
                zoom: 16,
                streetViewControl: true,
                styles: mapStyles,
                mapTypeId: 'satellite'
            });

            mapInstance.setCenter(coords);
            mapInstance.setOptions({ minZoom: 6, maxZoom: 15 });

            mapInstance.data.setStyle((feature) => {
                const { fillColor, strokeColor, fillOpacity, strokeOpacity, strokeWeight } = feature.getProperty('styles');
                return {
                    fillColor,
                    strokeColor,
                    fillOpacity,
                    strokeOpacity,
                    strokeWeight,
                };
            });

            mapInstance.data.addGeoJson({
                type: 'Feature',
                geometry: regionBoundary.geojson,
                properties: {
                    styles: {
                        fillColor: '#097ceb',
                        fillOpacity: 0.1,
                        strokeColor: '#646464',
                        strokeOpacity: 0.2,
                        strokeWeight: 2,
                    },
                },
            });

            try {
                const response = await Axios.get(districtsURL);
                districtsData = response.data;
                console.log('Data reveived', districtsData);
            } catch (err) {
                console.error('Could not get districts');
            }

            districtsData.forEach((district) => {
                mapInstance.data.addGeoJson({
                    type: 'Feature',
                    geometry: district.geojson,
                    properties: {
                        styles: {
                            strokeColor: '#1e73be',
                            fillColor: '#1e73be',
                            fillOpacity: '0.2',
                            strokeOpacity: '0.3',
                            strokeWeight: '1',
                        },
                    },
                });
            });

            updateObjects();
        }

        initializeMap();
    });
}
