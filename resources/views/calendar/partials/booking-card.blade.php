@php
    $isCompact = $height <= 90;
    $isMedium = $height > 90 && $height <= 140;
@endphp
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
    <div class="{{ $isCompact ? 'text-xs' : 'text-sm' }} font-semibold" style="word-break: break-word;">
        {{ $booking->client->name ?? '' }} - {{ $booking->client->phone ?? '' }}
    </div>


    {{-- TIME --}}
    <div class="{{ $isCompact ? 'text-xs' : 'text-sm' }} text-gray-700 mt-1">
        {{ $booking->start_at->format('H:i') }}
        —
        {{ $booking->end_at->format('H:i') }}
    </div>

    {{-- CAR --}}
    <div class="{{ $isCompact ? 'text-xs' : 'text-sm' }} text-gray-600 mt-2">
        {{ $booking->car_brand }}
        {{ $booking->car_model }}
    </div>

    {{-- COMPLAINTS --}}

    <div class="relative group mt-0">

        @if($isCompact)

            <div class="flex items-center gap-1">
            <span class="text-red-500 text-sm">
                ⚠
            </span>

                <span class="text-[10px] font-medium text-red-700">
                Жалоба
            </span>
            </div>

        @else

            <div class="flex gap-1 items-start">
            <span class="text-red-500">
                ⚠
            </span>

                <p class="
                text-sm leading-4
                    text-gray-700
                    break-words
" style="word-break: break-word;">
                    {{ Str::limit(
                        $booking->complaint,
                        $isMedium ? 35 : 60
                    ) }}
                </p>
            </div>

        @endif

        {{-- TOOLTIP --}}
        <div class="absolute z-50
        opacity-0 invisible
        group-hover:opacity-100
        group-hover:visible
        transition duration-200
        bg-black text-white text-xs
        rounded-lg px-3 py-2
        w-64 break-words shadow-lg
        bottom-full left-0 mb-2">

            {{ $booking->complaint }}

        </div>

    </div>

    <div class="absolute top-0 right-1 text-xs text-black font-semibold">
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
