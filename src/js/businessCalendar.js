import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';

export default function() {
    const businessCalendars = Array.from(document.querySelectorAll('.js-business-calendar'));

    businessCalendars.forEach(calendar => {
        const calendarInstance = new Calendar(calendar, {
            plugins: [dayGridPlugin],
            locale: 'ru',
            buttonText: {
                today: 'Сегодня',
                month: 'месяц',
                week: 'неделя',
                day: 'день',
                list: 'список'
            },
            events: '/wp-json/api/v1/events',
            eventTimeFormat: {
                hour: '2-digit',
                minute: '2-digit',
                omitZeroMinute: false
               
            }
        });

        calendarInstance.render();
    });
}
