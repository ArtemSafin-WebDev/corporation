const mapStyles = [
    { featureType: 'landscape.natural', elementType: 'geometry.fill', stylers: [{ color: '#ffffff' }] },
    { featureType: 'landscape.natural', elementType: 'geometry.stroke', stylers: [{ color: '#d9d9d9' }] },
    { featureType: 'landscape.natural.landcover', elementType: 'geometry.fill', stylers: [{ color: '#95eb34' }] },
    {
        featureType: 'landscape.man_made',
        elementType: 'geometry.fill',
        stylers: [
            {
                color: '#ffffff'
            }
        ]
    },
    {
        featureType: 'landscape.man_made',
        elementType: 'geometry.stroke',
        stylers: [
            {
                color: '#555555'
            }
        ]
    },
    { featureType: 'poi', stylers: [{ visibility: 'off' }] },
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
];

const DEFAULT_REGION_FILL_COLOR = '#097ceb';
const DEFAULT_REGION_STROKE_COLOR = '#646464';
const DEFAULT_REGION_FILL_OPACITY = 0.1;
const DEFAULT_REGION_STROKE_OPACITY = 0.2;
const DEFAULT_REGION_STROKE_WEIGHT = 2;
const CLUSTERS_COLOR = '#4BA4DB';


const DEFAULT_REGION_STYLES = {
    fillColor: DEFAULT_REGION_FILL_COLOR,
    strokeColor: DEFAULT_REGION_STROKE_COLOR,
    fillOpacity: DEFAULT_REGION_FILL_OPACITY,
    strokeOpacity: DEFAULT_REGION_STROKE_OPACITY,
    strokeWeight: DEFAULT_REGION_STROKE_WEIGHT
}

const getGoogleClusterInlineSvg = function(color) {
    var encoded = window.btoa(`<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="${color}"><path d="M256 0C114.837 0 0 114.837 0 256s114.837 256 256 256 256-114.837 256-256S397.163 0 256 0z"/></svg>`);
    return 'data:image/svg+xml;base64,' + encoded;
};

const clusterStyles = [
    {
        width: 40,
        height: 40,
        url: getGoogleClusterInlineSvg(CLUSTERS_COLOR),
        textColor: 'white',
        textSize: 16,
        anchorText: [10, 0]
    },
    {
        width: 50,
        height: 50,
        url: getGoogleClusterInlineSvg(CLUSTERS_COLOR),
        textColor: 'white',
        textSize: 18,
        anchorText: [14, 0]
    }
];

const addMapStyling = options => {
    return {
        ...options,
        styles: mapStyles
    };
};

const styleGeoData = map => {
    map.data.setStyle(feature => {
        const styles = feature.getProperty('styles');
        return {
            fillColor: (styles && styles.fillColor) || DEFAULT_REGION_FILL_COLOR,
            strokeColor: (styles && styles.strokeColor) || DEFAULT_REGION_STROKE_COLOR,
            fillOpacity: (styles && styles.fillOpacity) || DEFAULT_REGION_FILL_OPACITY,
            strokeOpacity: (styles && styles.strokeOpacity) || DEFAULT_REGION_STROKE_OPACITY,
            strokeWeight: (styles && styles.strokeWeight) || DEFAULT_REGION_STROKE_WEIGHT
        };
    });
};

export { addMapStyling, styleGeoData, clusterStyles, DEFAULT_REGION_STYLES };
