@if ($errors->any())

    <div style="background:red;color:white;padding:20px;">

        @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach

    </div>

@endif
<div class="space-y-6">

    {{-- Master --}}
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-700">
            Мастер
        </label>
        <select
            id="masterSelect"
            name="master_id"
            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        >
            @foreach($masters as $master)
                <option
                    value="{{ $master->id }}"
                    @selected(old('master_id', $booking->master_id ?? '') == $master->id)
                >
                    {{ $master->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Client --}}
<div>
    <label class="block mb-2 text-sm font-medium text-gray-700">
        Клиент
    </label>

        <select
            id="clientSelect"
            name="client_id"
            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        >
            @foreach($clients as $client)
                <option
                    value="{{ $client->id }}"
                    @selected(old('client_id', $booking->client_id ?? '') == $client->id)
                >
                    {{ $client->name }} — {{ $client->phone }}
                </option>
            @endforeach
        </select>
    </div>


    <div>
        <label class="block mb-2 text-sm font-medium text-gray-700">
            Статус
        </label>
        <select
            name="status"
            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        >
                <option selected disabled>Выберите статус</option>
            @foreach($statuses as $key => $status)
                <option
                    value="{{ $key }}"
                    @selected(old('status', $booking->status?->value) == $key)
                >
                    {{ $status }}
                </option>
            @endforeach

        </select>
    </div>

    <div>
        <label class="block mb-2 text-sm font-medium text-gray-700">
            Марка
        </label>

        <input
            type="text"
            name="car_brand"
            value="{{ old('car_brand', $booking->car_brand ?? '') }}"
            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        >

        @error('car_brand')
        <div class="text-red-500 text-sm mt-1">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div>
        <label class="block mb-2 text-sm font-medium text-gray-700">
            Модель
        </label>

        <input
            type="text"
            name="car_model"
            value="{{ old('car_model', $booking->car_model ?? '') }}"
            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        >

        @error('car_model')
        <div class="text-red-500 text-sm mt-1">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div>
        <label class="block mb-2 text-sm font-medium text-gray-700">
            Время записи
        </label>
        <input
            type="datetime-local"
            name="start_at"
            value="{{ old('start_at', isset($booking) ? $booking->start_at->format('Y-m-d\TH:i') : '') }}"
            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        >
        @error('start_at')
        <div class="text-red-500 text-sm mt-1">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div>
        <label class="block mb-2 text-sm font-medium text-gray-700">
            Продолжительность
        </label>
        <select
            name="duration"
            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        >

            @foreach([
                30 => '30 минут',
                60 => '1 час',
                90 => '1.5 часа',
                120 => '2 часа',
                180 => '3 часа',
            ] as $value => $label)

                <option
                    value="{{ $value }}"
                    @selected(old('duration', $booking->duration ?? 60) == $value)
                >
                {{ $label }}
                </option>

            @endforeach

        </select>

    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

    new TomSelect('#masterSelect', {
        create: false,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });

    new TomSelect('#clientSelect', {
        create: false,
        searchField: ['text'],
    });
    });
</script>

