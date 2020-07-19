const clusterIconTemplate = color => {
    return `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="${color}"><path d="M256 0C114.837 0 0 114.837 0 256s114.837 256 256 256 256-114.837 256-256S397.163 0 256 0z"/></svg>`;
};

const encodeClusterIcon = template => {
    const encoded = window.btoa(template);
    return 'data:image/svg+xml;base64,' + encoded;
};

const infoWindowTemplate = (title, link) => `<h4 class='invest-map__info-window-title'>${title}</h4>
<a href='${link}' target='_blank' class='invest-map__info-window-link'>Подробнее</a>`;



const taxonomyFilterTemplate = taxonomy => `
    <div class='invest-map__filter-taxonomy-row'>
        <h5 class='invest-map__filter-taxonomy-label'>
            ${taxonomy.label}
        </h5>
    </div>
`;


const filterCheckboxTemplate = data => `
    <label class="invest-map__filter-checkbox">
        <input type="checkbox" name="${data.taxonomy}" value="${data.slug}" class="invest-map__filter-checkbox-input" checked>
        <span class="invest-map__filter-checkbox-content">
            <span class="invest-map__filter-checkbox-checkmark"></span>
            <span class="invest-map__filter-checkbox-text">
                ${data.name}
            </span>
        </span>
    </label>
`;



const regionLegendTemplate = data => `
    <div class='invest-map__region'>
        <span class='invest-map__region-label'>
            <span class='invest-map__region-label-fill' style='background-color: ${data.fillColor}; opacity: ${data.fillOpacity};'>
            </span>
            <span class='invest-map__region-label-border' style='border-color: ${data.strokeColor}; opacity: ${data.strokeOpacity}'>
            </span>
        </span>
        <span class='invest-map__region-name'>Оренбургская область</span>
    </div>
`;


const districtLegendTemplate = data => `
    <span class='invest-map__legend-item-label' >
        <span class='invest-map__legend-item-label-fill' style='background-color: ${data.styles.fillColor}; opacity: ${data.styles.fillOpacity}'> </span>
        <span class='invest-map__legend-item-label-border' style='border-color: ${data.styles.strokeColor}; opacity: ${data.styles.strokeOpacity};'></span>
    </span>
    <span class='invest-map__legend-item-text'>${data.title}</span>
`;

export { infoWindowTemplate, filterCheckboxTemplate, regionLegendTemplate, districtLegendTemplate };
