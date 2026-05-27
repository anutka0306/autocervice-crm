@foreach($notes as $note)

    <div class="rounded-xl bg-gray-100 p-3 mb-4">

        <div class="flex justify-between items-start gap-2">

            <div>

                <div class="text-xs text-gray-500 flex justify-between">
                    <span>{{ $note->user->name }}</span> <span>{{ $note->created_at }}</span>
                </div>

                <p class="text-sm mt-1 break-words" style="word-break: break-word;">
                    {{ $note->text }}
                </p>

            </div>

            <form
                action="{{ route('general-notes.destroy', $note) }}"
                method="POST"
                class="delete-general-note-form"
            >
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="text-red-500 text-xs"
                >
                    ✕
                </button>
            </form>

        </div>

    </div>

@endforeach
