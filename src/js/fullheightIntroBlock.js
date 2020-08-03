export default function fullheightIntroBlock() {
    const frontPageIntroBlock = document.querySelector('.front-page-intro');

    if (frontPageIntroBlock && window.matchMedia("(max-width: 568px)").matches) {
        
        frontPageIntroBlock.style.minHeight = document.documentElement.clientHeight + 'px';
    }
}