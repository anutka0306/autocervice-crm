<x-app-layout>

    <div class="max-w-6xl mx-auto py-6 sm:py-10 px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- LEFT: FORM --}}
            <div class="lg:col-span-2 bg-white rounded-2xl shadow p-4 sm:p-6">

                <h1 class="text-2xl font-semibold mb-6">
                    Редактировать запись
                </h1>

                <form method="POST" action="{{ route('bookings.update', $booking) }}">
                    @csrf
                    @method('PUT')

                    @include('bookings._edit_form')

                    <button class="mt-6 bg-black text-white px-4 py-2 rounded">
                        Сохранить
                    </button>
                </form>

            </div>

            {{-- RIGHT: SIDEBAR --}}
            <div class="bg-white rounded-2xl shadow p-4 sm:p-6">

                @include('bookings._sidebar', [
                    'booking' => $booking
                ])

            </div>

        </div>

    </div>

</x-app-layout>
