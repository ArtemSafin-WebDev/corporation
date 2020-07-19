import InvestMap from "./classes/InvestMap";


export default function() {
    const mapElements = Array.from(document.querySelectorAll('.invest-map__map'));
    mapElements.forEach(element => new InvestMap(element));
}
