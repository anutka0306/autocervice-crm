<div
    class=" booking-card
        absolute
        left-2
        right-2
        rounded-xl
        p-3
        shadow
        border
        cursor-pointer
        transition
        hover:shadow-lg
        transition-all duration-200
"
data-booking-id="{{ $booking->id }}"


    style="
        top: {{ $top }}px;
        height: {{ $height }}px;
    {{ $booking->status->color() }};
        z-index: 10;
        "
    onclick="openSidebar({{ $booking->id }})"
>

    {{-- CLIENT --}}
    <div class="text-sm font-semibold">
        {{ $booking->client->name ?? '' }} {{ $booking->client->lastname ?? '' }}
    </div>
    <div class="text-sm font-semibold">
        {{ $booking->client->phone ?? '' }}
    </div>

    {{-- TIME --}}
    <div class="text-xs text-gray-700 mt-1">
        {{ $booking->start_at->format('H:i') }}
        —
        {{ $booking->end_at->format('H:i') }}
    </div>

    {{-- CAR --}}
    <div class="text-xs text-gray-600 mt-2">
        {{ $booking->car_brand }}
        {{ $booking->car_model }}
    </div>

    <div class="absolute top-2 right-2 text-xs text-black font-semibold">
        {{ $booking->status->label() }}
    </div>

    {{-- EDIT --}}
    <div class="absolute bottom-2 right-2">

        <a
            href="{{ route('bookings.edit', $booking) }}"
            class="
            w-7
            h-7
            flex
            items-center
            justify-center
            bg-white/90
            hover:bg-white
            rounded-lg
            border
            shadow-sm
            transition
        "
            onclick="event.stopPropagation()"
        >
            ✏️
        </a>

    </div>

    {{-- DELETE --}}
    <div class="absolute bottom-10 right-2">
    <form
        action="{{ route('bookings.destroy', [
        'booking' => $booking,
        'date' => request('date')
    ]) }}"

        method="POST"
        onsubmit="
            event.stopPropagation();

            return confirm(
                'Точно удалить запись?'
            );
        "
    >
        @csrf
        @method('DELETE')

        <button
            type="submit"
            class="
                w-7
                h-7
                flex
                items-center
                justify-center
                bg-red-50
                hover:bg-red-100
                text-red-600
                rounded-lg
                border
                shadow-sm
                transition
            "
        >
            🗑️
        </button>

    </form>
    </div>


</div>
