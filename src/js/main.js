import polyfills from './polyfills';
import detectTouch from './detectTouch';
import modals from './modals';
import successTabs from './success-tabs';
import newsSlider from './newsSlider';
import aboutRegionMaps from './aboutRegionMaps';
import indicators from './indicators';
import fixedHeader from './fixedHeader';
import stepSlider from './stepSlider';
import areasSlider from './areasSlider';
import objectsList from './objectsScrollList';
import supportMeasures from './supportMeasures';
import regionMaps from './regionMap';
import businessCalendars from './businessCalendar';
import objectsMap from './objectsMap';
import rangeSlider from './rangeSliders';
import events from './events';
import objectCardMap from './objectCardMap';
import anchors from './anchors';
import corporationMap from './corporationMap';
import booking from './booking';
import freeSlider from './freeSlider';
import scrollAnimations from './scrollAnimations';
import investInstitutesReveal from './investInstitutesReveal';
import regionEconomics from './regionEconomics';
import npa from './npa';
import objectsFiltersBtns from './objectFiltersBtnsActivity';
import projectsSingleSlider from './projectsSingleSlider';

window.addEventListener('load', () => {
    setTimeout(() => {
        document.body.classList.add('animatable')
    }, 300)
})


document.addEventListener('DOMContentLoaded', function() {
    polyfills();
    detectTouch();
   
    newsSlider();
    modals();
    rangeSlider();
    successTabs();
    aboutRegionMaps();
    indicators();
    fixedHeader();
    stepSlider();
    areasSlider();
    objectsList();
    supportMeasures();
    regionMaps();
    businessCalendars();
    objectsMap();
    events();
    objectCardMap();
    anchors();
    corporationMap();
    booking();
    freeSlider();
    scrollAnimations();
    investInstitutesReveal();
    regionEconomics();
    npa();
    objectsFiltersBtns();
    projectsSingleSlider();
});
