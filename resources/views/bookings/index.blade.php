<x-app-layout>

    <div class="max-w-6xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

            <h1 class="text-2xl font-semibold">
                Записи
            </h1>

            <a
                href="{{ route('bookings.create') }}"
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
                    <th class="text-left p-4">Клиент</th>
                    <th class="text-left p-4">Телефон</th>
                    <th class="text-left p-4">Мастер</th>
                    <th class="text-left p-4">Машина</th>
                    <th class="text-left p-4">Статус</th>
                    <th class="text-left p-4">Время</th>
                    <th class="p-4"></th>
                </tr>
                </thead>

                <tbody>

                @foreach($bookings as $booking)

                    <tr class="border-t">

                        <td class="p-4">
                            {{ $booking->client->name }}
                        </td>

                        <td class="p-4">
                            {{ $booking->client->phone }}
                        </td>

                        <td class="p-4">
                            {{ $booking->master->name }}
                        </td>

                        <td class="p-4">
                            {{ $booking->car_brand }} {{ $booking->car_model }}
                        </td>
                        <td class="p-4">
                            {{ $booking->status->label() }}
                        </td>
                        <td class="p-4">
                            {{ $booking->start_at->format('d.m.Y H:i') }}
                        </td>


                        <td class="p-4 text-right">
                            <a href="{{ route('bookings.edit', $booking) }}">
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
            {{ $bookings->links() }}
        </div>

    </div>

</x-app-layout>
