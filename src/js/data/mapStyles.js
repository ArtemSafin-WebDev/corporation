const mapStyles = [
    { featureType: 'landscape.natural', elementType: 'geometry.fill', stylers: [{ color: '#ffffff' }] },
    { featureType: 'landscape.natural', elementType: 'geometry.stroke', stylers: [{ color: '#d9d9d9' }] },
    // { featureType: 'landscape.natural.landcover', elementType: 'geometry.fill', stylers: [{ color: '#95eb34' }] },
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


export default mapStyles;
