import { addMapStyling, styleGeoData, clusterStyles, DEFAULT_REGION_STYLES } from './styling';
import { getAreaGeodataByName, getObjects, getDistricts, getAreaAdminLevel, getObjectTypes } from './api';
import { infoWindowTemplate, filterCheckboxTemplate, regionLegendTemplate, districtLegendTemplate } from './templates';
import MarkerClusterer from '@google/markerclustererplus';
import Axios from 'axios';



const districtDataForExport = [];

const mapOptions = {
    zoom: 7,
    streetViewControl: false
};

const setRegion = async (map, regionName, geoDataProvider, geoDataSetter) => {
    let results;
    try {
        results = await geoDataProvider(regionName);
    } catch (err) {
        throw new Error(`Could not get GeoData for region with name ${regionName}`);
    }

    const regionData = results[0];

    map.setCenter({ lat: 1 * regionData.lat, lng: 1 * regionData.lon });

    geoDataSetter(map, regionData.geojson);
};

const placeMarkers = (map, objects, infoWindowTemplate) => {
  
    const infoWindows = [];
    const markers = [];

    for (let object of objects) {
        if (!object.coords.lat || !object.coords.lng) {
            continue;
        }
        const coords = {
            lat: object.coords.lat,
            lng: object.coords.lng
        };

        const infoWindow = new google.maps.InfoWindow({
            content: infoWindowTemplate(object.title, object.permalink),
            maxWidth: 300
        });

        infoWindows.push(infoWindow);

        const marker = new google.maps.Marker({
            position: coords,
            title: object.title,
            map
        });

        marker.addListener('click', () => {
            infoWindow.open(map, marker);
            infoWindows.forEach(element => {
                if (infoWindow !== element) {
                    element.close();
                }
            });
        });

        markers.push(marker);
    }

    const clusterer = new MarkerClusterer(map, markers, {
        styles: clusterStyles
    });

    return {
        markers,
        clusterer
    };
};

const placeObjects = async (map, objectsProvider, infoWindowTemplate, setMarkers) => {
    let objects = [];

    try {
        objects = await objectsProvider();
    } catch (error) {
        console.error(error);
        return;
    }

    const markersInfo = setMarkers(map, objects, infoWindowTemplate);

    return markersInfo;
};

const placeDistricts = async (map, districtsProvider, geoDataProvider, getAdminLevel, geoDataSetter) => {
    let districts;
    try {
        districts = await districtsProvider();
    } catch (error) {
        console.error(error);
       
        return;
    }

    console.log('Районы', districts);
    for (let district of districts) {
        let geoData;

        try {
            geoData = await geoDataProvider(district.title);
        } catch (error) {
            console.error(error);
            console.error(`Error for district ${district}`)
            continue;
        }

        for (let dataItem of geoData) {
            let adminLevel;
            const id = dataItem.osm_id;
            const placeId = dataItem.place_id;

            console.log(`Place ID for ${district.title}`, placeId);
            const { geojson } = dataItem;

            try {
                adminLevel = await getAdminLevel(id, placeId);
            } catch (error) {
                console.error(error);
              
                continue;
            }

            if (adminLevel != 6) {
                console.log(`${district.title} has admin level of ${adminLevel}`);
            }

            geoDataSetter(map, geojson, {
                styles: district.styles
            });

            console.log(id, adminLevel);
        }
    }

    return districts;
};

const addGeoJSONtoMap = (map, data, dataProperties = {}) => {
    map.data.addGeoJson({
        type: 'Feature',
        geometry: data,
        properties: {
            ...dataProperties
        }
    });
};


const placeLegend = (map, districts) => {
    const legendWrapper = document.createElement('div');
    legendWrapper.className = 'invest-map__legend';
    legendWrapper.innerHTML = regionLegendTemplate(DEFAULT_REGION_STYLES);

    districts.forEach(district => {
        const legendItem = document.createElement('div');
        legendItem.className = 'invest-map__legend-item';

        legendItem.innerHTML = districtLegendTemplate(district);

        legendWrapper.appendChild(legendItem);
    })

    map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(legendWrapper);
}

const filter = async (map, mapElement, initialMarkersInfo, placeMarkers, infoWindowTemplate) => {
    const filterWrapper = mapElement.parentElement.querySelector('.invest-map__filter');
    const objectTypeCheckboxes = filterWrapper.querySelector('.invest-map__filter-checkboxes-group');
    let checkboxes = [];
    let markersInfo = initialMarkersInfo;

    const filterResults = async () => {
        const queryParams = new URLSearchParams();

        checkboxes.forEach(box => {
            console.log('boxName', box.name);
            console.log('boxValue', box.value);
            console.log('checked', box.checked);
            if (!box.checked) {
                queryParams.append(box.name + '[]', box.value);
            }
        });

        let filteredResults;

        try {
            filteredResults = await Axios.get('/wp-json/api/v1/objects', {
                params: queryParams
            });
        } catch (error) {
            console.error(error);
            return;
        }

        markersInfo.markers.forEach(marker => marker.setMap(null));
        markersInfo.clusterer.clearMarkers();

        markersInfo = placeMarkers(map, filteredResults.data, infoWindowTemplate);

        console.log('Search params', queryParams.toString());
        console.log('Filtered results', filteredResults.data);
    };

    if (!filterWrapper) {
        console.error('No filter element');
        return;
    }
    let objectTypes;

    try {
        objectTypes = await getObjectTypes();
    } catch (err) {
        console.error(err);
    }

    for (let objectType of objectTypes) {
        const checkboxWrapper = document.createElement('div');
        checkboxWrapper.className = 'invest-map__filter-checkbox-wrapper';
        checkboxWrapper.innerHTML = filterCheckboxTemplate(objectType);
        objectTypeCheckboxes.appendChild(checkboxWrapper);
        const checkBoxInputElement = checkboxWrapper.querySelector('input[type="checkbox"]');
        checkboxes.push(checkBoxInputElement);
    }

    checkboxes.forEach(checkbox => checkbox.addEventListener('change', filterResults));
};

const initializeMap = (element, options) => {
    let mapInstance = new google.maps.Map(element, options);
    mapInstance.setOptions({ minZoom: 6, maxZoom: 15 });
    return mapInstance;
};

export default function() {
    const mapElements = Array.from(document.querySelectorAll('.invest-map__map'));
    mapElements.forEach(async element => {
        const map = initializeMap(element, addMapStyling(mapOptions));
        let markersInfo = [];
        let districts;
        styleGeoData(map);
        try {
            await setRegion(map, 'Оренбургская область', getAreaGeodataByName, addGeoJSONtoMap);
            markersInfo = await placeObjects(map, getObjects, infoWindowTemplate, placeMarkers);
            filter(map, element, markersInfo, placeMarkers, infoWindowTemplate);
            districts = await placeDistricts(map, getDistricts, getAreaGeodataByName, getAreaAdminLevel, addGeoJSONtoMap);
            // placeLegend(map, districts);
        } catch (err) {
            console.error(err);
            return;
        }
    });
}
