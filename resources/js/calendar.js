window.openSidebar = async function (id) {

    const sidebar =
        document.getElementById('sidebar');

    sidebar.innerHTML = `
        <div class="text-sm text-gray-500">
            Загрузка...
        </div>
    `;

    const response = await fetch(
        `/bookings/${id}/sidebar`
    );

    const html = await response.text();

    sidebar.innerHTML = html;

    /*
    |--------------------------------------------------------------------------
    | ACTIVE CARD
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll('.booking-card')
        .forEach(card => {

            card.classList.remove(
                'ring-2',
                'ring-blue-400',
                'shadow-2xl',
                'scale-[1.02]',
                'z-20',
                'selected-booking'
            );
        });

    const activeCard =
        document.querySelector(
            `[data-booking-id="${id}"]`
        );

    if (activeCard) {

        activeCard.classList.add(
            'ring-2',
            'ring-blue-400',
            'shadow-2xl',
            'scale-[1.02]',
            'z-20',
            'selected-booking'
        );
    }
}

/*
|--------------------------------------------------------------------------
| CALENDAR BUTTON
|--------------------------------------------------------------------------
*/

const toggleButton =
    document.getElementById('toggleCalendar');

const calendarWrapper =
    document.getElementById('calendarWrapper');

const sidebarWrapper =
    document.getElementById('sidebarWrapper');

let collapsed = false;

if (toggleButton) {

    toggleButton.addEventListener('click', () => {

        collapsed = !collapsed;

        if (collapsed) {

            calendarWrapper.classList.add('hidden');

            sidebarWrapper.classList.add('mx-auto');

            toggleButton.innerText =
                'Показать календарь';

        } else {

            calendarWrapper.classList.remove('hidden');

            sidebarWrapper.classList.remove('mx-auto');

            toggleButton.innerText =
                'Скрыть календарь';
        }
    });
}

/*
|--------------------------------------------------------------------------
| NOTE FORM
|--------------------------------------------------------------------------
*/

document.addEventListener(
    'submit',
    async function (e) {

        if (!e.target.matches('#noteForm')) {
            return;
        }

        e.preventDefault();

        const form = e.target;

        const formData =
            new FormData(form);

        await fetch(form.action, {

            method: 'POST',

            headers: {
                'X-CSRF-TOKEN':
                    document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
            },

            body: formData,
        });

        openSidebar(
            form.dataset.booking
        );
    }
);
