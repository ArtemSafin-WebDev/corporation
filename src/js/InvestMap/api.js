import Axios from 'axios';

const SEARCH_URL = 'http://nominatim.openstreetmap.org/search';
const DETAILS_URL = 'https://nominatim.openstreetmap.org/details';
const OBJECTS_URL = '/wp-json/api/v1/objects';
const DISTRICTS_URL = '/wp-json/api/v1/districts';
const OBJECT_TYPES_URL = '/wp-json/api/v1/objects/types';

const getAreaGeodataByName = async name => {
    let result;
    try {
        result = await Axios.get(SEARCH_URL, {
            params: {
                q: name,
                format: 'json',
                polygon_geojson: 1
            }
        });
    } catch (error) {
        console.error(error);
        return null;
    }

    return result.data;
};

const getAreaAdminLevel = async (id, placeId) => {
    let result;

    try {
        result = await Axios.get(DETAILS_URL, {
            params: {
                format: 'json',
                // osmtype: 'R',
                // osmid: id,
                place_id: placeId
            }
        });
    } catch (error) {
        console.error(error);
        return null;
    }

    return result.data && result.data.admin_level;
};

const getObjects = async filters => {
    let result = [];
    try {
        result = await Axios.get(OBJECTS_URL);
    } catch (error) {
        throw new Error('Could not get objects');
    }

    return result.data;
};

const getDistricts = async filters => {
    let result = [];
    try {
        result = await Axios.get(DISTRICTS_URL);
    } catch (error) {
        console.error(error);
        return null;
    }

    return result.data;
};

const getObjectTypes = async () => {
    let objectTypes;
    try {
        objectTypes = await Axios.get(OBJECT_TYPES_URL);
    } catch (error) {
        throw new Error('Could not get object types');
    }

    return objectTypes.data;
};

export { getAreaGeodataByName, getObjects, getObjectTypes, getDistricts, getAreaAdminLevel };
