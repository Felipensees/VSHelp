<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Novo Setor
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <form method="POST" action="{{ route('sectors.store') }}">

                        @csrf

                        <div class="mb-4">

                            <label for="name" class="block font-medium">
                                Nome
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                class="w-full border-gray-300 rounded"
                                required
                            >

                            @error('name')
                                <p class="text-red-600 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        <div class="mb-4">

                            <label for="description" class="block font-medium">
                                Descrição
                            </label>

                            <textarea
                                id="description"
                                name="description"
                                class="w-full border-gray-300 rounded"
                            >{{ old('description') }}</textarea>

                        </div>

                        <div class="mb-4">

                            <label>
                                <input
                                    type="checkbox"
                                    name="active"
                                    value="1"
                                    checked
                                >

                                Setor ativo
                            </label>

                        </div>

                        <div class="flex gap-3">

                            <a
                                href="{{ route('sectors.index') }}"
                                class="px-4 py-2 bg-gray-200 rounded"
                            >
                                Cancelar
                            </a>

                            <button
                                type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded"
                            >
                                Salvar
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>