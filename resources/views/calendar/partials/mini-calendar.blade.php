<div id="calendarWrapper"
     class="bg-gray-50 rounded-xl p-4 min-w-[300px]">

    <div class="flex items-center justify-between mb-4">

        <a
            href="{{ route('calendar.index', [
                    'date' => $date->copy()->subMonth()->format('Y-m-d')
                ]) }}"
            class="text-sm"
        >
            ←
        </a>

        <div class="font-semibold">
            {{ $date->translatedFormat('F Y') }}
        </div>

        <a
            href="{{ route('calendar.index', [
                    'date' => $date->copy()->addMonth()->format('Y-m-d')
                ]) }}"
            class="text-sm"
        >
            →
        </a>

    </div>

    <div class="grid grid-cols-7 gap-1 text-center text-sm w-full">

        {{-- WEEK DAYS --}}
        @foreach(['Пн','Вт','Ср','Чт','Пт','Сб','Вс'] as $weekDay)

            <div class="text-gray-400 text-xs font-semibold py-2">
                {{ $weekDay }}
            </div>

        @endforeach

        @php

            $startOfMonth = $date->copy()->startOfMonth();

            $daysInMonth = $date->daysInMonth;

            $startWeekday = $startOfMonth->dayOfWeekIso;

        @endphp

        {{-- EMPTY DAYS --}}
        @for($i = 1; $i < $startWeekday; $i++)

            <div class="aspect-square"></div>

        @endfor

        {{-- DAYS --}}
        @for($day = 1; $day <= $daysInMonth; $day++)

            @php

                $currentDate = $date->copy()->day($day);

                $isActive = $currentDate->isSameDay($date);

                $isToday = $currentDate->isToday();

            @endphp

            <a
                href="{{ route('calendar.index', [
                'date' => $currentDate->format('Y-m-d')
            ]) }}"
                class="
                aspect-square
                flex
                items-center
                justify-center
                rounded-xl
                transition
                text-sm
                hover:bg-blue-100

                {{ $isActive
                    ? 'bg-blue-500 text-white font-semibold'
                    : ''
                }}

                {{ $isToday && !$isActive
                    ? 'border border-blue-400'
                    : ''
                }}
                    "
            >
                {{ $day }}
            </a>

        @endfor

    </div>

</div>
