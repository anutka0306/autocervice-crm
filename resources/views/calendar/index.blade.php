@php
    $calendarStartHour = 8;
    $calendarEndHour = 20;

    $hourHeight = 100;
    $minuteHeight = $hourHeight / 60;

    $timelineHeight =
        ($calendarEndHour - $calendarStartHour)
        * $hourHeight;
@endphp

<x-app-layout>

    <div class="max-w-[1800px] mx-auto py-6 px-4">
        <div class="w-full flex  items-center">
            <h1 class="text-2xl font-bold mb-6 me-6">
                Календарь: {{ $date }}
            </h1>

            <a
                href="{{ route('bookings.create') }}"
                class="px-5 py-2.5 mb-6 ms-6 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700"
            >
                Создать запись
            </a>
        </div>

        <div class="flex gap-4 h-[calc(100vh-120px)]">


            {{-- CALENDAR --}}
            <div
                class="flex-1 bg-white rounded-2xl shadow overflow-auto"
            >

                <div class="flex min-w-[1200px]">

                    {{-- TIME COLUMN --}}
                    <div class="w-24 border-r bg-white sticky left-0 z-30 shrink-0">

                        {{-- EMPTY HEADER --}}
                        <div class="h-[60px] border-b bg-gray-100"></div>

                        @for($h = $calendarStartHour; $h <= $calendarEndHour; $h++)

                            <div
                                class="border-t text-sm text-gray-500 px-3 pt-2"
                                style="height: {{ $hourHeight }}px"
                            >
                                {{ sprintf('%02d:00', $h) }}
                            </div>

                        @endfor

                    </div>

                    {{-- MASTERS GRID --}}
                    <div
                        class="flex-1 grid relative"
                        style="
                            grid-template-columns:
                            repeat({{ $masters->count() }}, minmax(260px, 1fr));
                            "
                    >

                        @foreach($masters as $master)

                            <div class="border-r relative">

                                {{-- MASTER HEADER --}}
                                <div
                                    class="
                                        h-[60px]
                                        bg-gray-100
                                        border-b
                                        px-4
                                        flex
                                        items-center
                                        text-sm
                                        font-semibold
                                        sticky
                                        top-0
                                        z-20
                                    "
                                >
                                    {{ $master->name }}
                                </div>

                                {{-- TIMELINE --}}
                                <div
                                    class="relative"
                                    style="height: {{ $timelineHeight }}px"
                                >

                                    {{-- HOUR LINES --}}
                                    @for($h = 0; $h <= ($calendarEndHour - $calendarStartHour); $h++)

                                        <div
                                            class="absolute left-0 right-0 border-t border-gray-200"
                                            style="top: {{ $h * $hourHeight }}px"
                                        ></div>

                                    @endfor

                                    {{-- BOOKINGS --}}
                                    @foreach($bookings as $booking)

                                        @continue($booking->master_id != $master->id)

                                        @php

                                            /*
                                             |--------------------------------------------------------------------------
                                             | START POSITION
                                             |--------------------------------------------------------------------------
                                             */

                                            $bookingMinutes =
                                                ($booking->start_at->hour * 60)
                                                + $booking->start_at->minute;

                                            $calendarStartMinutes =
                                                $calendarStartHour * 60;

                                            $top =
                                                ($bookingMinutes - $calendarStartMinutes)
                                                * $minuteHeight;

                                            /*
                                             |--------------------------------------------------------------------------
                                             | HEIGHT
                                             |--------------------------------------------------------------------------
                                             */

                                            $durationMinutes =
                                                $booking->start_at
                                                    ->diffInMinutes($booking->end_at);

                                            $height =
                                                max(
                                                    110,
                                                    $durationMinutes * $minuteHeight
                                                );

                                        @endphp

                                        @include('calendar.partials.booking-card', [
                                                    'booking' => $booking,
                                                    'top' => $top,
                                                    'height' => $height,
                                                ])

                                    @endforeach

                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>

            {{-- SIDEBAR --}}
            <div class="space-y-6">

                {{-- MINI CALENDAR --}}
                <button
                    id="toggleCalendar"
                    class="
                z-50
                bg-white
                border
                rounded-lg
                shadow
                px-3
                py-2
                text-sm"
                >
                    Скрыть календарь
                </button>
                @include('calendar.partials.mini-calendar')

            {{-- BOOKING SIDEBAR --}}

            @include('calendar.partials.sidebar')

</div>

</div>

</div>

    @vite('resources/js/calendar.js')

</x-app-layout>
