import mapStyles from './data/mapStyles';
import regionBoundary from './data/region';

import Axios from 'axios';
import MarkerClusterer from '@google/markerclustererplus';
import PerfectScrollbar from 'perfect-scrollbar';
import noUiSlider from 'noUiSlider';

export default function() {
    const objectsMaps = Array.from(document.querySelectorAll('.js-objects-map'));
    const rangeSliders = Array.from(document.querySelectorAll('.js-range-slider'));
    const rangeSliderInstances = [];

    const mapCenter = {
        lat: 53.304384,
        lng: 56.283222
    };

    // const iconBrownfield = {
    //     url: '../img/icon_Brownfield.svg',
    //     size: new google.maps.Size(sizeX, sizeY),
    //     origin: new google.maps.Point(0, 0),
    //     anchor: new google.maps.Point(sizeX / 2, sizeY / 2)
    // };

    const encoded = window.btoa(`<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#4BA4DB"><path d="M256 0C114.837 0 0 114.837 0 256s114.837 256 256 256 256-114.837 256-256S397.163 0 256 0z"/></svg>`);

    const clustererInlineSVG = 'data:image/svg+xml;base64,' + encoded;

    const clustererStyles = [
        {
            width: 40,
            height: 40,
            url: clustererInlineSVG,
            textColor: 'white',
            textSize: 16,
            anchorText: [10, 0]
        },
        {
            width: 50,
            height: 50,
            url: clustererInlineSVG,
            textColor: 'white',
            textSize: 18,
            anchorText: [14, 0]
        }
    ];

    rangeSliders.forEach(rangeSlider => {
        const input = rangeSlider.querySelector('input[type="range"]');
        const sliderElement = rangeSlider.querySelector('.objects-map__range-slider');
        const priceElement = rangeSlider.querySelector('.objects-map__range-slider-price');

        const min = input.hasAttribute('min') ? input.getAttribute('min') : 0;
        const max = input.hasAttribute('max') ? input.getAttribute('max') : 15000000;
        const step = input.hasAttribute('step') ? input.getAttribute('step') : 1;
        const initialValue = input.value;
        console.log('initial', initialValue);

        noUiSlider.create(sliderElement, {
            start: [initialValue ? +initialValue : 1],
            connect: 'lower',
            orientation: 'horizontal',
            step: +step,
            range: {
                min: +min,
                max: +max
            }
        });

        sliderElement.noUiSlider.on('update', function() {
            const value = +sliderElement.noUiSlider.get();
            const event = new CustomEvent('rangeupdate', { value });
            input.value = value;
            input.dispatchEvent(event);
            priceElement.textContent = value.toLocaleString();
        });

        const sliderInstance = {
            input,
            sliderElement
        };

        rangeSliderInstances.push(sliderInstance);
    });

    objectsMaps.forEach(map => {
        let mapInstance = null;
        const mapElement = map.querySelector('.objects-map__map');
        const totalObjectsElement = map.querySelector('.objects-map__objects-total-amount');
        const objectsListElement = map.querySelector('.objects-map__objects-list');
        const objectsScrollWrapper = map.querySelector('.objects-map__objects-list-scroll-wrapper');
        let customScrollInstance = null;
        const infoWindows = [];
        let markers = [];
        let clusterer = null;
        let districtsData = [];
        const rootURL = map.hasAttribute('data-root-url') ? map.getAttribute('data-root-url') : '/';
        const districtsURL = map.hasAttribute('data-districts') ? map.getAttribute('data-districts') : '';
        console.log('Districts URL', districtsURL);

        const filtersState = {
            type: {
                active: false,
                brownfield: true,
                greenfield: true
            },
            area: {
                active: false,
                landArea: 0,
                objectArea: 0
            },
            transport: {
                active: false,
                railroadDistance: 0,
                roadDistance: 0
            },
            infra: {
                active: false,
                water: false,
                waterPower: 0,
                gas: false,
                gasPower: 0,
                electricity: false,
                electricPower: 0,
                sewers: false,
                sewersPower: 0,
                heat: false,
                heatPower: 0
            }
        };

        let filtersInitialState = null;

        function dispatchResetEvent() {
            const event = new CustomEvent('reset');
            document.dispatchEvent(event);
        }

        function bindFilters() {
            const brownfieldCheckbox = map.querySelector('input[type="checkbox"][value="brownfield"]');
            const greenfieldCheckbox = map.querySelector('input[type="checkbox"][value="greenfield"]');
            const applyTypeBtn = map.querySelector('.objects-map__filters-group--type .objects-map__filters-group-apply-btn');
            const resetTypeBtn = map.querySelector('.objects-map__filters-group--type .objects-map__filters-group-reset-btn');
            const landAreaInput = map.querySelector('.objects-map__filters-group--type input[type="range"][name="land-area"]');
            const objectAreaInput = map.querySelector('.objects-map__filters-group--type input[type="range"][name="object-area"]');

            const landAreaRangeInstance = rangeSliderInstances.find(element => element.input === landAreaInput);
            const objectAreaRangeInstance = rangeSliderInstances.find(element => element.input === objectAreaInput);

            const railroadDistanceInput = map.querySelector('.objects-map__filters-group--transport input[type="range"][name="railroad-distance"]');
            const roadDistanceInput = map.querySelector('.objects-map__filters-group--transport input[type="range"][name="road-distance"]');

            const railroadDistanceRangeInstance = rangeSliderInstances.find(element => element.input === railroadDistanceInput);
            const roadDistanceRangeInstance = rangeSliderInstances.find(element => element.input === roadDistanceInput);
            const applyTransportBtn = map.querySelector('.objects-map__filters-group--transport .objects-map__filters-group-apply-btn');
            const resetTransportBtn = map.querySelector('.objects-map__filters-group--transport .objects-map__filters-group-reset-btn');

            const gasCheckbox = map.querySelector('.objects-map__filters-group--infra input[type="checkbox"][name="gas"]');
            const gasPowerElement = map.querySelector('input[name="gas-power"]');
            const waterCheckbox = map.querySelector('.objects-map__filters-group--infra input[type="checkbox"][name="water"]');
            const waterPowerElement = map.querySelector('input[name="water-power"]');
            const heatCheckbox = map.querySelector('.objects-map__filters-group--infra input[type="checkbox"][name="heat"]');
            const heatPowerElement = map.querySelector('input[name="heat-power"]');
            const sewersCheckbox = map.querySelector('.objects-map__filters-group--infra input[type="checkbox"][name="sewers"]');
            const sewersPowerElement = map.querySelector('input[name="sewers-power"]');
            const electricityCheckbox = map.querySelector('.objects-map__filters-group--infra input[type="checkbox"][name="electricity"]');
            const electricPowerElement = map.querySelector('input[name="electric-power"]');

            const applyInfraBtn = map.querySelector('.objects-map__filters-group--infra .objects-map__filters-group-apply-btn');
            const resetInfraBtn = map.querySelector('.objects-map__filters-group--infra .objects-map__filters-group-reset-btn');

            if (brownfieldCheckbox.checked) {
                filtersState.type.brownfield = true;
            } else {
                filtersState.type.brownfield = false;
            }
            if (greenfieldCheckbox.checked) {
                filtersState.type.greenfield = true;
            } else {
                filtersState.type.greenfield = false;
            }

            brownfieldCheckbox.addEventListener('change', function(event) {
                if (event.target.checked) {
                    filtersState.type.brownfield = true;
                } else {
                    filtersState.type.brownfield = false;
                }
            });
            greenfieldCheckbox.addEventListener('change', function(event) {
                if (event.target.checked) {
                    filtersState.type.greenfield = true;
                } else {
                    filtersState.type.greenfield = false;
                }
            });

            applyTypeBtn.addEventListener('click', function(event) {
                event.preventDefault();
                filtersState.type.active = true;
                const group = this.closest('.objects-map__filters-group');
                if (group) {
                    group.classList.add('applied');
                }
                updateObjects();
            });
            resetTypeBtn.addEventListener('click', function(event) {
                event.preventDefault();
               
                filtersState.type.active = false;

                filtersState.area.landArea = filtersInitialState.area.landArea;
                filtersState.area.objectArea = filtersInitialState.area.objectArea;
                filtersState.type.greenfield = filtersInitialState.type.greenfield;
                filtersState.type.brownfield = filtersInitialState.type.brownfield;
                brownfieldCheckbox.checked = filtersInitialState.type.brownfield;
                greenfieldCheckbox.checked = filtersInitialState.type.greenfield;

                landAreaRangeInstance.sliderElement.noUiSlider.set(filtersInitialState.area.landArea);
                objectAreaRangeInstance.sliderElement.noUiSlider.set(filtersInitialState.area.objectArea);
                const group = this.closest('.objects-map__filters-group');
                if (group) {
                    group.classList.remove('applied');
                }
                updateObjects();
                dispatchResetEvent();
            });

            filtersState.area.landArea = landAreaInput.value;

            landAreaInput.addEventListener('rangeupdate', function() {
                filtersState.area.landArea = landAreaInput.value;
            });
            filtersState.area.objectArea = objectAreaInput.value;

            objectAreaInput.addEventListener('rangeupdate', function() {
                filtersState.area.objectArea = objectAreaInput.value;
            });

            filtersState.transport.railroadDistance = railroadDistanceInput.value;

            railroadDistanceInput.addEventListener('rangeupdate', function() {
                filtersState.transport.railroadDistance = railroadDistanceInput.value;
            });
            filtersState.transport.roadDistance = roadDistanceInput.value;

            roadDistanceInput.addEventListener('rangeupdate', function() {
                filtersState.transport.roadDistance = roadDistanceInput.value;
            });

            applyTransportBtn.addEventListener('click', function(event) {
                event.preventDefault();
                filtersState.transport.active = true;
                const group = this.closest('.objects-map__filters-group');
                if (group) {
                    group.classList.add('applied');
                }
                updateObjects();
            });
            resetTransportBtn.addEventListener('click', function(event) {
                event.preventDefault();
               
                filtersState.transport.active = false;

                filtersState.transport.railroadDistance = filtersInitialState.transport.railroadDistance;
                filtersState.transport.roadDistance = filtersInitialState.transport.roadDistance;

                railroadDistanceRangeInstance.sliderElement.noUiSlider.set(filtersInitialState.transport.railroadDistance);
                roadDistanceRangeInstance.sliderElement.noUiSlider.set(filtersInitialState.transport.roadDistance);

                const group = this.closest('.objects-map__filters-group');
                if (group) {
                    group.classList.remove('applied');
                }
                updateObjects();
                dispatchResetEvent();
            });

            if (gasCheckbox.checked) {
                filtersState.infra.gas = true;
            } else {
                filtersState.infra.gas = false;
            }

            gasCheckbox.addEventListener('change', function(event) {
                if (event.target.checked) {
                    filtersState.infra.gas = true;
                } else {
                    filtersState.infra.gas = false;
                }
            });

            filtersState.infra.gasPower = +gasPowerElement.value;

            gasPowerElement.addEventListener('change', function() {
                filtersState.infra.gasPower = +gasPowerElement.value;
            });

            if (heatCheckbox.checked) {
                filtersState.infra.heat = true;
            } else {
                filtersState.infra.heat = false;
            }

            heatCheckbox.addEventListener('change', function(event) {
                if (event.target.checked) {
                    filtersState.infra.heat = true;
                } else {
                    filtersState.infra.heat = false;
                }
            });

            filtersState.infra.heatPower = +heatPowerElement.value;

            heatPowerElement.addEventListener('change', function() {
                filtersState.infra.heatPower = +heatPowerElement.value;
            });

            if (sewersCheckbox.checked) {
                filtersState.infra.sewers = true;
            } else {
                filtersState.infra.sewers = false;
            }

            sewersCheckbox.addEventListener('change', function(event) {
                if (event.target.checked) {
                    filtersState.infra.sewers = true;
                } else {
                    filtersState.infra.sewers = false;
                }
            });

            filtersState.infra.sewersPower = +sewersPowerElement.value;

            sewersPowerElement.addEventListener('change', function() {
                filtersState.infra.sewersPower = +sewersPowerElement.value;
            });

            if (waterCheckbox.checked) {
                filtersState.infra.water = true;
            } else {
                filtersState.infra.water = false;
            }

            waterCheckbox.addEventListener('change', function(event) {
                if (event.target.checked) {
                    filtersState.infra.water = true;
                } else {
                    filtersState.infra.water = false;
                }
            });

            filtersState.infra.waterPower = +waterPowerElement.value;

            waterPowerElement.addEventListener('change', function() {
                filtersState.infra.waterPower = +waterPowerElement.value;
            });

            if (electricityCheckbox.checked) {
                filtersState.infra.electricity = true;
            } else {
                filtersState.infra.electricity = false;
            }

            electricityCheckbox.addEventListener('change', function(event) {
                if (event.target.checked) {
                    filtersState.infra.electricity = true;
                } else {
                    filtersState.infra.electricity = false;
                }
            });

            filtersState.infra.electricPower = +electricPowerElement.value;

            electricPowerElement.addEventListener('change', function() {
                filtersState.infra.electricPower = +electricPowerElement.value;
            });

            applyInfraBtn.addEventListener('click', function(event) {
                event.preventDefault();
                filtersState.infra.active = true;
                const group = this.closest('.objects-map__filters-group');
                if (group) {
                    group.classList.add('applied');
                }
                updateObjects();
            });
            resetInfraBtn.addEventListener('click', function(event) {
                event.preventDefault();
               
                filtersState.infra.active = false;
                filtersState.infra.electricity = filtersInitialState.infra.electricity;
                filtersState.infra.gas = filtersInitialState.infra.gas;
                filtersState.infra.heat = filtersInitialState.infra.heat;
                filtersState.infra.water = filtersInitialState.infra.water;
                filtersState.infra.sewers = filtersInitialState.infra.sewers;

                waterCheckbox.checked = filtersInitialState.infra.water;
                electricityCheckbox.checked = filtersInitialState.infra.electricity;
                heatCheckbox.checked = filtersInitialState.infra.heat;
                sewersCheckbox.checked = filtersInitialState.infra.sewers;
                gasCheckbox.checked = filtersInitialState.infra.gas;

                filtersState.infra.electricPower = filtersInitialState.infra.electricPower;
                filtersState.infra.waterPower = filtersInitialState.infra.waterPower;
                filtersState.infra.sewersPower = filtersInitialState.infra.sewersPower;
                filtersState.infra.gasPower = filtersInitialState.infra.gasPower;
                filtersState.infra.heatPower = filtersInitialState.infra.heatPower;

                waterPowerElement.value = filtersInitialState.infra.waterPower;
                electricPowerElement.value = filtersInitialState.infra.electricPower;
                gasPowerElement.value = filtersInitialState.infra.gasPower;
                heatPowerElement.value = filtersInitialState.infra.heatPower;
                sewersPowerElement.value = filtersInitialState.infra.sewersPower;

                const group = this.closest('.objects-map__filters-group');
                if (group) {
                    group.classList.remove('applied');
                }
                updateObjects();
                dispatchResetEvent();
            });

            filtersInitialState = JSON.parse(JSON.stringify(filtersState));
        }

        async function updateObjects() {
            const queryParams = new URLSearchParams();

            console.log(filtersState);

            if (filtersState.type.active) {
                if (filtersState.type.brownfield) {
                    queryParams.append('type[]', 'brownfield');
                }
                if (filtersState.type.greenfield) {
                    queryParams.append('type[]', 'greenfield');
                }

                queryParams.set('land_area', filtersState.area.landArea);
                queryParams.set('object_area', filtersState.area.objectArea);
            }

            if (filtersState.transport.active) {
                queryParams.set('railroad_distance', filtersState.transport.railroadDistance);
                queryParams.set('road_distance', filtersState.transport.roadDistance);
            }

            if (filtersState.infra.active) {
                if (filtersState.infra.gas) {
                    queryParams.set('gas', 1);
                    queryParams.set('gas_power', filtersState.infra.gasPower);
                }
                if (filtersState.infra.water) {
                    queryParams.set('water', 1);
                    queryParams.set('water_power', filtersState.infra.waterPower);
                }
                if (filtersState.infra.electricity) {
                    queryParams.set('electricity', 1);
                    queryParams.set('electric_power', filtersState.infra.electricPower);
                }
                if (filtersState.infra.heat) {
                    queryParams.set('heat', 1);
                    queryParams.set('heat_power', filtersState.infra.heatPower);
                }
                if (filtersState.infra.sewers) {
                    queryParams.set('sewers', 1);
                    queryParams.set('sewers_power', filtersState.infra.sewersPower);
                }
            }

            console.log('Query params', queryParams.toString());

            let objects = [];
            try {
                const result = await Axios.get('/wp-json/api/v1/objects', {
                    params: queryParams
                });
                objects = result.data;
            } catch (error) {
                console.error('Could not get objects');
            }

            console.log('Objects', objects);

            markers.forEach(marker => marker.setMap(null));
            markers = [];
            if (clusterer) clusterer.clearMarkers();

            for (let object of objects) {
                if (!object.coords.lat || !object.coords.lng) {
                    continue;
                }
                const coords = {
                    lat: object.coords.lat,
                    lng: object.coords.lng
                };

                const infoWindowImage = object.card_image ? `<img src="${object.card_image}" class="objects-map__info-window-icon"/>` : '';

                const infoWindow = new google.maps.InfoWindow({
                    content: `
                        <div class="objects-map__info-window objects-map__info-window--${object.type}">
                            <div class="objects-map__info-window-icon-container">
                                ${infoWindowImage}
                            </div>
                            <div class="objects-map__info-window-content">
                                <h5 class="objects-map__info-window-title">
                                    ${object.title}
                                </h5>
                                <p class="objects-map__info-window-paragraph">
                                    Площадь участка: ${object.land_area} га
                                </p>
                                <a target="_blank" href="${object.permalink}" class="objects-map__info-window-more-link">Посмотреть</a>
                            </div>
                        </div>
                    `,
                    maxWidth: 350
                });

                infoWindows.push(infoWindow);

                const marker = new google.maps.Marker({
                    position: coords,
                    title: object.title,
                    map: mapInstance,
                    icon: {
                        url: rootURL + '/img/pin.svg',
                        size: new google.maps.Size(40, 40),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(40/2, 40)
                    }

                    // icon: rootURL + '/img/icon_Brownfield.svg'
                });

                marker.addListener('click', () => {
                    infoWindow.open(mapInstance, marker);
                    infoWindows.forEach(element => {
                        if (infoWindow !== element) {
                            element.close();
                        }
                    });
                });

                markers.push(marker);
            }

            clusterer = new MarkerClusterer(mapInstance, markers, {
                styles: clustererStyles
            });

            if (objects.length > 0) {
                totalObjectsElement.textContent = `Найдено объектов: ${objects.length}`;
            } else {
                totalObjectsElement.textContent = `Объектов не найдено`;
            }

            objectsListElement.innerHTML = '';

            for (let object of objects) {
                const coords = {
                    lat: object.coords.lat,
                    lng: object.coords.lng
                };

                const propertyType = object.property_type
                    ? `<p class="objects-map__objects-card-parameter">
                    <span class="objects-map__objects-card-parameter-name">
                        Форма собственности:
                    </span>
                    ${object.property_type}
                </p>`
                    : '';

                const gas = object.gas
                    ? `<span class="objects-map__objects-card-infra-item" title="Газоснабжение">
                    <svg width="15" height="15" aria-hidden="true" class="icon-gas">
                        <use xlink:href="#gas" />
                    </svg>
                </span>`
                    : '';
                const water = object.water
                    ? `<span class="objects-map__objects-card-infra-item" title="Водоснабжение">
                    <svg width="15" height="15" aria-hidden="true" class="icon-water">
                        <use xlink:href="#water" />
                    </svg>
                </span>`
                    : '';
                const sewers = object.sewers
                    ? `<span class="objects-map__objects-card-infra-item" title="Канализация">
                    <svg width="15" height="15" aria-hidden="true" class="icon-sewers">
                        <use xlink:href="#sewers" />
                    </svg>
                </span>`
                    : '';
                const heat = object.heat
                    ? `<span class="objects-map__objects-card-infra-item" title="Теплоснабжение">
                    <svg width="15" height="15" aria-hidden="true" class="icon-heat">
                        <use xlink:href="#heat" />
                    </svg>
                </span>`
                    : '';
                const electricity = object.electricity
                    ? `<span class="objects-map__objects-card-infra-item" title="Электричество">
                    <svg width="15" height="15" aria-hidden="true" class="icon-electricity">
                        <use xlink:href="#electricity" />
                    </svg>
                </span>`
                    : '';

                const objectArea = object.object_area
                    ? `
                    <p class="objects-map__objects-card-parameter">
                    <span class="objects-map__objects-card-parameter-name">
                        Площадь объекта:
                    </span>
                    ${object.object_area} м²
                </p>
                `
                    : '';

                const cardImage = object.card_image ? `<img class="objects-map__objects-card-image" src="${object.card_image}"/>` : '';

                const zoomIn =
                    object.coords.lat && object.coords.lng
                        ? `<a href="#" class="objects-map__objects-card-zoom-in">
                    <svg width="15" height="15" aria-hidden="true" class="icon-location">
                        <use xlink:href="#location" />
                    </svg>
                </a>`
                        : '';


                const objectCardNumber = object.object_card_number ? `<span class="number">${object.object_card_number}.</span>` : '';

                const card = `<div class="objects-map__objects-card objects-map__objects-card--${object.type}">

            
                <a target="_blank" href="${object.permalink}" class="objects-map__objects-card-image-container">
                    ${cardImage}
                </a>

                <div class="objects-map__objects-card-content">
                   
                    <h5 class="objects-map__objects-card-title">
                        
                        <a href="${object.permalink}">
                        ${objectCardNumber}
                        ${object.title}</a>
                        ${zoomIn}
                    </h5>
                    <p class="objects-map__objects-card-parameter">
                        <span class="objects-map__objects-card-parameter-name">
                            Площадь участка:
                        </span>
                        ${object.land_area} га
                    </p>
                    ${objectArea}
                    ${propertyType}
                    <div class="objects-map__objects-card-more-wrapper">
                        <a target="_blank" href="${object.permalink}" class="objects-map__objects-card-more">
                            Подробнее
                        </a>
                        <div class="objects-map__objects-card-infra">
                            ${electricity}
                            ${gas}
                            ${water}
                            ${sewers}
                            ${heat}
                        </div>
                    </div>
                   
                </div>
            </div>`;
                const listItem = document.createElement('li');
                listItem.className = 'objects-map__objects-list-item';
                listItem.innerHTML = card;

                const zoomInBtn = listItem.querySelector('.objects-map__objects-card-zoom-in');

                if (zoomInBtn) {
                    zoomInBtn.addEventListener('click', event => {
                        event.preventDefault();
                        mapInstance.setZoom(14);
                        mapInstance.panTo(coords);
                    });
                }

                objectsListElement.appendChild(listItem);
            }

            if (customScrollInstance) {
                customScrollInstance.update();
            }
        }

        async function initializeMap() {
            mapInstance = new google.maps.Map(mapElement, {
                zoom: 6,
                streetViewControl: false,
                fullscreenControl: false,
                styles: mapStyles
            });

            mapInstance.setCenter(mapCenter);
            mapInstance.setOptions({ minZoom: 6, maxZoom: 15 });

            mapInstance.data.setStyle(feature => {
                const { fillColor, strokeColor, fillOpacity, strokeOpacity, strokeWeight } = feature.getProperty('styles');
                return {
                    fillColor,
                    strokeColor,
                    fillOpacity,
                    strokeOpacity,
                    strokeWeight
                };
            });

            mapInstance.data.addGeoJson({
                type: 'Feature',
                geometry: regionBoundary.geojson,
                properties: {
                    styles: {
                        fillColor: '#dadada',
                        fillOpacity: 0.1,
                        strokeColor: '#a5a5a5',
                        strokeOpacity: 0.2,
                        strokeWeight: 2
                    }
                }
            });

            try {
                const response = await Axios.get(districtsURL);
                districtsData = response.data;
                console.log('Data reveived', districtsData);
            } catch (err) {
                console.error('Could not get districts');
            }

            districtsData.forEach(district => {
                mapInstance.data.addGeoJson({
                    type: 'Feature',
                    geometry: district.geojson,
                    properties: {
                        styles: {
                            strokeColor: '#a5a5a5;',
                            fillColor: '#dadada',
                            fillOpacity: '0.2',
                            strokeOpacity: '0.3',
                            strokeWeight: '1'
                        }
                    }
                });
            });

            customScrollInstance = new PerfectScrollbar(objectsScrollWrapper, {
                wheelSpeed: 5,
                wheelPropagation: false,
                minScrollbarLength: 238
            });

            bindFilters();

            updateObjects();
        }

        

        initializeMap();
    });
}
