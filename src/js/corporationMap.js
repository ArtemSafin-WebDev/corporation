export default function() {
    const corporationMaps = Array.from(document.querySelectorAll('.js-corporation-map'));

    corporationMaps.forEach(map => {
        const mapCenter = {
            lat: 51.770528,
            lng: 55.096601
        };
        const mapInstance = new google.maps.Map(map, {
            zoom: 17
        });

        mapInstance.setCenter(mapCenter);

        const marker = new google.maps.Marker({
            position: mapCenter,
            map: mapInstance,
            title: 'Корпорация развития Оренбургской области'
        });
    });
}
