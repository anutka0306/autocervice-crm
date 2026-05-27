<div
    id="sidebarWrapper"
    class="
        space-y-6
        sticky
        top-6
        h-fit
        w-[320px]
        shrink-0
    "
>

    <div
        id="generalNotes"
        class="bg-white rounded-2xl shadow p-4"
    >

        <div class="flex items-center justify-between mb-4">

            <h2 class="font-semibold text-lg">
                Общие заметки
            </h2>

        </div>

        <form
            id="generalNoteForm"
            action="{{ route('general-notes.store') }}"
            method="POST"
            class="mb-4"
        >
            @csrf

            <textarea
                name="text"
                rows="7"
                placeholder="Добавить заметку..."
                class="w-full rounded-xl border-gray-300 text-sm"
            ></textarea>

            <button
                class="mt-2 w-full rounded-xl bg-black text-white py-2 text-sm"
            >
                Добавить
            </button>

        </form>

        <div class="space-y-3">
            <div id="generalNotesList">

                @include('notes._list', [
                    'notes' => $notes
                ])
            </div>

        </div>

    </div>

</div>
