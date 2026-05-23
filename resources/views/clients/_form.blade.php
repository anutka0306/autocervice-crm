<div class="space-y-6">

    <div>
        <label class="block mb-2 text-sm font-medium text-gray-700">
            Имя
        </label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $client->name ?? '') }}"
            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        >

        @error('name')
        <div class="text-red-500 text-sm mt-1">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div>
        <label class="block mb-2 text-sm font-medium text-gray-700">
            Фамилия
        </label>

        <input
            type="text"
            name="lastname"
            value="{{ old('name', $client->lastname ?? '') }}"
            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        >

        @error('lastname')
        <div class="text-red-500 text-sm mt-1">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div>
        <label class="block mb-2 text-sm font-medium text-gray-700">
            Телефон
        </label>

        <input
            type="tel"
            name="phone"
            value="{{ old('phone', $client->phone ?? '') }}"
            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        >

        @error('phone')
        <div class="text-red-500 text-sm mt-1">
            {{ $message }}
        </div>
        @enderror
    </div>


</div>
