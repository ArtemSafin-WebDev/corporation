import Axios from 'axios';
import MarkerClusterer from '@google/markerclustererplus';

class InvestMap {
    constructor(element) {
        this.elements = {
            mapContainer: element
        };

        this.state = {
            map: null,
            regionName: 'Оренбургская область',
            defaultRegionColor: '#097ceb',
            defaultRegionStrokeColor: '#646464',
            defaultRegionFillOpacity: 0.1,
            defaultRegionStrokeOpacity: 0.2,
            defaultRegionStrokeWeight: 2,
            initialMapOptions: {
                zoom: 7,
                center: { lat: 52.0269262, lng: 54.7276647 },
                streetViewControl: false,
                styles: [
                    { featureType: 'landscape.natural', elementType: 'geometry.fill', stylers: [{ color: '#ffffff' }] },
                    { featureType: 'landscape.natural', elementType: 'geometry.stroke', stylers: [{ color: '#d9d9d9' }] },
                    { featureType: 'landscape.natural.landcover', elementType: 'geometry.fill', stylers: [{ color: '#95eb34' }] },
                    { featureType: 'poi.park', stylers: [{ visibility: 'off' }] },

                    {
                        featureType: 'road.highway',
                        elementType: 'geometry',
                        stylers: [{ visibility: 'off' }]
                    },
                    {
                        featureType: 'water',

                        stylers: [{ visibility: 'off' }]
                    },
                    {
                        featureType: 'administrative.neighborhood',
                        elementType: 'labels',
                        stylers: [{ visibility: 'off' }]
                    },
                    {
                        featureType: 'administrative.land_parcel',
                        elementType: 'labels',
                        stylers: [{ visibility: 'off' }]
                    }
                ]
            }
        };

        this.data = {};
        this.initializeMap();
        this.styleGeoData();

        this.getObjectsData();
        this.getDistrictsData();
        this.addRegionBorders();
    }

    async addRegionBorders() {
        let regionGeoData;

        try {
            regionGeoData = await Axios.get(`http://nominatim.openstreetmap.org/search`, {
                params: {
                    q: this.state.regionName,
                    format: 'json',
                    polygon_geojson: 1
                }
            });
        } catch (err) {
            console.error(err);
            return;
        }

        console.log('Region geo data', regionGeoData.data);

        regionGeoData.data.forEach(data => {
            this.state.map.data.addGeoJson({
                type: 'Feature',
                geometry: data.geojson,
                properties: {
                    title: 'Оренбургская область'
                }
            });
        });
    }

    createMapLegend(elements) {
        const legendWrapper = document.createElement('div');
        legendWrapper.className = 'invest-map__legend';
        legendWrapper.innerHTML = `
            <div class='invest-map__region'>
                <span class='invest-map__region-label'>
                    <span class='invest-map__region-label-fill' style='background-color: ${this.state.defaultRegionColor}; opacity: ${this.state.defaultRegionFillOpacity};'>
                    </span>
                    <span class='invest-map__region-label-border' style='border-color: ${this.state.defaultRegionStrokeColor}; opacity: ${this.state.defaultRegionStrokeOpacity}'>
                    </span>
                </span>
                <span class='invest-map__region-name'>Оренбургская область</span>
            </div>
        `;
        elements.forEach(element => {
            const legendItem = document.createElement('div');
            console.log('Element', element);
            legendItem.className = 'invest-map__legend-item';
            legendItem.innerHTML = `
                <span class='invest-map__legend-item-label' >
                    <span class='invest-map__legend-item-label-fill' style='background-color: ${(element.style && element.style.fillColor) || this.state.defaultRegionColor}; opacity: ${(element.style && element.style.fillOpacity) ||
                this.state.defaultRegionFillOpacity}'> </span>
                    <span class='invest-map__legend-item-label-border' style='border-color: ${(element.style && element.style.strokeColor) || this.state.defaultRegionStrokeColor}; opacity: ${(element.style && element.style.strokeOpacity) ||
                this.state.defaultRegionStrokeOpacity};'>
                    </span>
                </span>
                <span class='invest-map__legend-item-text'>${element.title}</span>
            `;
            legendWrapper.appendChild(legendItem);
        });

        console.log('Legend elements', elements);

        this.state.map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(legendWrapper);
    }

    styleGeoData() {
        this.state.map.data.setStyle(feature => {
            const styles = feature.getProperty('style');

            return {
                fillColor: (styles && styles.fillColor) || this.state.defaultRegionColor,
                fillOpacity: (styles && styles.fillOpacity) || this.state.defaultRegionFillOpacity,
                strokeColor: (styles && styles.strokeColor) || this.state.defaultRegionStrokeColor,
                strokeWeight: (styles && styles.strokeWidth) || this.state.defaultRegionStrokeWeight,
                strokeOpacity: (styles && styles.strokeOpacity) || this.state.defaultRegionStrokeOpacity
            };
        });
    }

    placeObjectsMarkers(objects) {
        let infoWindows = [];
        let markers = [];

        for (let object of objects) {
            if (!object.coords.lat || !object.coords.lng) {
                continue;
            }
            const coords = {
                lat: object.coords.lat,
                lng: object.coords.lng
            };

            console.log(coords);

            const objectInfoPopup = new google.maps.InfoWindow({
                content: `
                    <h4 class='invest-map__info-window-title'>${object.title}</h4>
                    <a href='${object.permalink}' target='_blank' class='invest-map__info-window-link'>Подробнее</a>`,
                maxWidth: 300
            });

            infoWindows.push(objectInfoPopup);

            const marker = new google.maps.Marker({ position: coords, title: object.title, map: this.state.map });

            marker.addListener('click', () => {
                objectInfoPopup.open(this.state.map, marker);
                infoWindows.forEach(element => {
                    if (element !== objectInfoPopup) {
                        element.close();
                    }
                });
            });

            markers.push(marker);
        }

        const getGoogleClusterInlineSvg = function(color) {
            var encoded = window.btoa(`<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="${color}"><path d="M256 0C114.837 0 0 114.837 0 256s114.837 256 256 256 256-114.837 256-256S397.163 0 256 0z"/></svg>`);

            return 'data:image/svg+xml;base64,' + encoded;
        };

        const clusterStyles = [
            {
                width: 40,
                height: 40,
                url: getGoogleClusterInlineSvg('#0086f9'),
                textColor: 'white',
                textSize: 16,
                anchorText: [10, 0]
            },
            {
                width: 50,
                height: 50,
                url: getGoogleClusterInlineSvg('#0086f9'),
                textColor: 'white',
                textSize: 18,
                anchorText: [14, 0]
            }
        ];

        new MarkerClusterer(this.state.map, markers, {
            styles: clusterStyles
        });
    }

    async getObjectsData() {
        let objects = [];
        try {
            objects = await Axios.get('/wp-json/api/v1/objects');
        } catch (err) {
            console.error(err);
            return;
        }

        console.log('Objects', objects.data);

        this.placeObjectsMarkers(objects.data);
    }

    async getDistrictsData() {
        let districts = [];
        try {
            districts = await Axios.get('/wp-json/api/v1/districts');
        } catch (err) {
            console.error(err);
            return;
        }

        

        const legendElements = [];

        for (let district of districts.data) {
            console.log('District', district);
            const districtName = district.title;
            let districtGeoData;
            try {
                districtGeoData = await Axios.get(`http://nominatim.openstreetmap.org/search`, {
                    params: {
                        q: districtName,
                        format: 'json',
                        polygon_geojson: 1,
                        admin_level: 6
                    }
                });
            } catch (err) {
                console.error(err);
                return;
            }
            console.log('District geo data', districtGeoData);

            if (districtGeoData.data.length > 0) {
                districtGeoData.data.forEach(dataItem => {
                    this.state.map.data.addGeoJson({
                        type: 'Feature',
                        geometry: dataItem.geojson,
                        properties: {
                            style: {
                                fillColor: district.map.fillColor,
                                strokeColor: district.map.strokeColor,
                                strokeOpacity: district.map.strokeOpacity,
                                fillOpacity: district.map.fillOpacity,
                                strokeWeight: district.map.strokeWidth
                            }
                        }
                    });

                    legendElements.push({
                        title: district.title,
                        style: {
                            fillColor: district.map.fillColor,
                            strokeColor: district.map.strokeColor,
                            strokeOpacity: district.map.strokeOpacity,
                            fillOpacity: district.map.fillOpacity,
                            strokeWeight: district.map.strokeWidth
                        }
                    });
                });
            } else {
                console.error(`Не найдены геоданные по названию района: ${district.title}`);
            }
        }

        this.createMapLegend(legendElements);
    }

    initializeMap() {
        this.state.map = new google.maps.Map(this.elements.mapContainer, this.state.initialMapOptions);
    }
}

export default InvestMap;
