import flatpickr from 'flatpickr';
import { Russian } from 'flatpickr/dist/l10n/ru.js';
import Axios from 'axios';

export default function() {
    const events = Array.from(document.querySelectorAll('.js-events'));

    events.forEach(element => {
        const calendar = element.querySelector('.events__calendar');
        const list = element.querySelector('.news-archive__list');

        async function updateEvents(selectedDates, dateStr, instance) {
            let events = [];

            const year = instance.currentYear;
            const month = instance.currentMonth;


            const firstDay = new Date(year, month, 1);

            const lastDay = new Date(year, month + 1, 0);

            const firstDayFormatted = [firstDay.getFullYear(), ('0' + (firstDay.getMonth() + 1)).slice(-2), ('0' + firstDay.getDate()).slice(-2)].join('-');
            const lastDayFormatted = [lastDay.getFullYear(), ('0' + (lastDay.getMonth() + 1)).slice(-2), ('0' + lastDay.getDate()).slice(-2)].join('-');

            console.log('First day', firstDayFormatted);
            console.log('Last day', lastDayFormatted);

            try {
                const results = await Axios.get('/wp-json/api/v1/events', {
                    params: {
                        start: firstDayFormatted,
                        end: lastDayFormatted
                    }
                });
                events = results.data;
            } catch (error) {
                console.error('Could not get events dates');
            }

            console.log('Reveived events', events);

            if (events.length === 0) return;

            list.innerHTML = '';

            events.forEach(event => {
                const listItem = document.createElement('li');
                listItem.className = 'news-archive__list-item';

                const card = `
                    <a href="${event.url}" class="news-slider__card">
                        <div class="news-slider__card-image-container">
                            ${event.thumbnail}
                            <div class="news-slider__card-label">
                                ${event.start}
                            </div>
                        </div>
                        <div class="news-slider__card-content">
                            <span class="news-slider__card-date">
                                ${event.creation_date}
                            </span>
                            <h5 class="news-slider__card-title">
                                ${event.title}
                            </h5>
                        </div>
                    </a>
                `;

                listItem.innerHTML = card;
                list.appendChild(listItem);
            });
        }

        async function initializeCalendar() {
            let dates = [];
            try {
                const results = await Axios.get('/wp-json/api/v1/events/dates');
                dates = results.data;
            } catch (error) {
                console.error('Could not get events dates');
            }

            console.log('Enabled dates', dates);

            const options = {
                inline: true,
                enable: dates,
                locale: Russian,
                onMonthChange: updateEvents,
                onReady: updateEvents
            };

            if (dates.length > 0) {
                options.defaultDate = dates[0];
            }

            flatpickr(calendar, options);
        }

        initializeCalendar();
    });
}
