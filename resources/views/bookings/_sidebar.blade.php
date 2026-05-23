<h2 class="text-lg font-semibold mb-4">
    Заметки
</h2>

<div class="
        space-y-3
        mb-4
        max-h-[400px]
        overflow-y-auto
        pr-2
        scrollbar-thin
        "
    >

    @foreach($booking->notes as $note)
        <div class="border p-2 rounded">

            <div class="text-sm">
                {{ $note->text }}
            </div>

            <div class="text-xs text-gray-500">
                {{ $note->user->name ?? '' }}
            </div>

            <form method="POST" action="{{ route('notes.destroy', $note) }}">
                @csrf
                @method('DELETE')

                <button class="text-red-500 text-xs">
                    удалить
                </button>
            </form>

        </div>
    @endforeach

</div>

<form
    id="noteForm"
    method="POST"
    action="{{ route('bookings.notes.store', $booking) }}"
    data-booking="{{ $booking->id }}"
>
    @csrf

    <textarea
        id="noteText"
        name="text"
        class="w-full border rounded p-2 text-sm"
        placeholder="Добавить заметку..."
    ></textarea>

    <button class="mt-2 bg-blue-500 text-white px-3 py-1 rounded text-sm">
        Добавить
    </button>
</form>

