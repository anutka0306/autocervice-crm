<div class="space-y-6">

    <div>
        <label class="block mb-2 text-sm font-medium text-gray-700">
            Имя
        </label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $user->name ?? '') }}"
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
            Email
        </label>

        <input
            type="email"
            name="email"
            value="{{ old('email', $user->email ?? '') }}"
            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        >

        @error('email')
        <div class="text-red-500 text-sm mt-1">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div>
        <label class="block mb-2 text-sm font-medium text-gray-700">
            Пароль
        </label>

        <input
            type="password"
            name="password"
            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        >

        @error('password')
        <div class="text-red-500 text-sm mt-1">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div>
        <label class="block mb-2 text-sm font-medium text-gray-700">
            Роль
        </label>

        <select
            name="role"
            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        >
            <option
                value="master"
                @selected(old('role', $user->role ?? '') === 'master')
            >
            Мастер
            </option>

            <option
                value="admin"
                @selected(old('role', $user->role ?? '') === 'admin')
            >
            Админ
            </option>
        </select>
    </div>

    <div class="flex items-center gap-2">
        <input type="hidden" name="is_active" value="0">

        <input
            type="checkbox"
            name="is_active"
            value="1"
            @checked(old('is_active', $user->is_active ?? false))
        >
        <label class="text-sm text-gray-700">
            Активен
        </label>
    </div>

</div>
