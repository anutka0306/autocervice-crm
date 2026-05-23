<x-app-layout>

    <div class="max-w-2xl mx-auto py-10">

        <div class="bg-white rounded-2xl shadow p-6">

            <h1 class="text-2xl font-semibold mb-6">
                Создать Запись
            </h1>

            <form method="POST" action="{{ route('bookings.store') }}">

                @csrf

                @include('bookings._form')

                <div class="mt-8">
                    <button
                        type="submit"
                        class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700"
                    >
                        Сохранить
                    </button>
                </div>

            </form>

        </div>

    </div>

</x-app-layout>
