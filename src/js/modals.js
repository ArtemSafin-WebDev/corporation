export default function() {
    const modals = Array.from(document.querySelectorAll('.js-modal'));
    const modalOpenBtns = Array.from(document.querySelectorAll('.js-modal-open, .regional-competence__info-card-link[href^="#"], .schema__steps-card a[href^="#"]'));
    const modalCloseBtns = Array.from(document.querySelectorAll('.js-modal-close'));

    function closeAllModals() {
        modals.forEach(modal => modal.classList.remove('active'));
    }

    function openModal(event) {
        event.preventDefault();
        const hash = event.currentTarget.hash;
        if (!hash) return;
        const modal = modals.find(element => '#' + element.id === hash);
        if (modal) {
            console.log(modal);
            closeAllModals();
            modal.classList.add('active');
        } else {
            console.error('Modal not found');
        }
    }

    function closeModal(event) {
        event.preventDefault();
        const btn = event.currentTarget;
        const modal = btn.closest('.js-modal');
        if (modal) {
            modal.classList.remove('active');
        }
    }

    modalOpenBtns.forEach(btn => btn.addEventListener('click', openModal));
    modalCloseBtns.forEach(btn => btn.addEventListener('click', closeModal));
    modals.forEach(modal => modal.addEventListener('click', event => {
        if (event.currentTarget === event.target) modal.classList.remove('active');
    }))
}