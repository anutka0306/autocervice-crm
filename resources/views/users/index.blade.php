<x-app-layout>

    <div class="max-w-6xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

            <h1 class="text-2xl font-semibold">
                Мастера
            </h1>

            <a
                href="{{ route('users.create') }}"
                class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700"
            >
                Создать
            </a>

        </div>

        <div class="bg-white rounded-2xl shadow overflow-hidden">
            <div class="overflow-x-auto">

                <table class="w-full">

                <thead class="bg-gray-100">
                <tr>
                    <th class="text-left p-4">Имя</th>
                    <th class="text-left p-4">Email</th>
                    <th class="text-left p-4">Роль</th>
                    <th class="text-left p-4">Статус</th>
                    <th class="p-4"></th>
                </tr>
                </thead>

                <tbody>

                @foreach($users as $user)

                    <tr class="border-t">

                        <td class="p-4">
                            {{ $user->name }}
                        </td>

                        <td class="p-4">
                            {{ $user->email }}
                        </td>

                        <td class="p-4">
                            {{ $user->role }}
                        </td>

                        <td class="p-4">

                            @if($user->is_active)
                                <span class="text-green-600">
                                        Активен
                                    </span>
                            @else
                                <span class="text-red-600">
                                        Выключен
                                    </span>
                            @endif

                        </td>

                        <td class="p-4 text-right">

                            <a
                                href="{{ route('users.edit', $user) }}"
                                class="text-indigo-600 hover:text-indigo-800"
                            >
                                Редактировать
                            </a>

                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>

            </div>
        </div>

        <div class="mt-6">
            {{ $users->links() }}
        </div>

    </div>

</x-app-layout>
