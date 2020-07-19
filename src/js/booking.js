export default function() {
    const bookingBtn = document.querySelector('.js-booking');

    if (bookingBtn) {
        const eventNameField = document.querySelector('#event-name');
        const eventName = document.querySelector('h1');

        if (eventNameField && eventName) {
            eventNameField.value = eventName.textContent.trim();
        }
    }
}
