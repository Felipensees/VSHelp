<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Novo Totem
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <h3 class="text-lg font-semibold text-gray-900">
                        Identificação do Totem
                    </h3>

                    <p class="text-sm text-gray-500 mt-1 mb-6">
                        Informe o pedido e o número de série antes de iniciar a inspeção.
                    </p>

                    <form
                        method="POST"
                        action="{{ route('totem-inspections.store') }}"
                    >
                        @csrf

                        <div class="mb-5">
                            <label
                                for="order_number"
                                class="block text-sm font-medium text-gray-700 mb-1"
                            >
                                Pedido
                            </label>

                            <input
                                id="order_number"
                                type="text"
                                name="order_number"
                                value="{{ old('order_number') }}"
                                required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('order_number')
                                <p class="text-sm text-red-600 mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label
                                for="serial_number"
                                class="block text-sm font-medium text-gray-700 mb-1"
                            >
                                Serial Number
                            </label>

                            <input
                                id="serial_number"
                                type="text"
                                name="serial_number"
                                value="{{ old('serial_number') }}"
                                required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('serial_number')
                                <p class="text-sm text-red-600 mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex justify-end gap-3">

                            <a
                                href="{{ route('totem-inspections.index') }}"
                                class="px-4 py-2 border border-gray-300 rounded-md text-gray-700"
                            >
                                Cancelar
                            </a>

                            <button
                                type="submit"
                                class="px-5 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
                            >
                                Iniciar inspeção
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>