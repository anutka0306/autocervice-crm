<x-app-layout>

    <div class="max-w-2xl mx-auto py-10">

        <div class="bg-white rounded-2xl shadow p-6">

            <h1 class="text-2xl font-semibold mb-6">
                Редактировать клиента
            </h1>

            <form
                method="POST"
                action="{{ route('clients.update', $client) }}"
            >

                @csrf
                @method('PUT')

                @include('clients._form')

                <div class="mt-8 flex gap-3">

                    <button
                        type="submit"
                        class="inline-flex items-center px-4 py-2 bg-black text-white rounded-md hover:bg-gray-800"
                    >
                        Сохранить
                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>
