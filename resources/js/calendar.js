async function reloadGeneralNotes()
{
    const response = await fetch(
        '/general-notes'
    );

    const html = await response.text();

    document
        .getElementById('generalNotesList')
        .innerHTML = html;
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

        if (!e.target.matches('#generalNoteForm')) {
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

        form.reset();

        reloadGeneralNotes();
    }
);

document.addEventListener(
    'submit',
    async function (e) {

        if (!e.target.matches('.delete-general-note-form')) {
            return;
        }

        e.preventDefault();

        const form = e.target;

        const formData = new FormData(form);

        await fetch(form.action, {

            method: 'POST',

            headers: {
                'X-CSRF-TOKEN':
                    document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,

                'X-Requested-With':
                    'XMLHttpRequest',
            },

            body: formData,
        });

        reloadGeneralNotes();
    }
);
