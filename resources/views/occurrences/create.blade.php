<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nova Ocorrência
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    @if (session('error'))
                        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('occurrences.store') }}">

                        @csrf

                        <div class="mb-4">
                            <label class="block font-medium">
                                Título *
                            </label>

                            <input
                                type="text"
                                name="title"
                                value="{{ old('title') }}"
                                class="w-full border-gray-300 rounded"
                                required
                            >

                            @error('title')
                                <p class="text-red-600 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium">
                                Modelo do Totem *
                            </label>

                            <input
                                type="number"
                                name="totem_model_id"
                                value="{{ old('totem_model_id') }}"
                                class="w-full border-gray-300 rounded"
                                required
                            >

                            <p class="text-sm text-gray-500 mt-1">
                                Temporário até o CRUD de modelos ser integrado.
                            </p>

                            @error('totem_model_id')
                                <p class="text-red-600 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <div class="mb-4">
                                <label class="block font-medium">
                                    Pedido *
                                </label>

                                <input
                                    type="text"
                                    name="order_number"
                                    value="{{ old('order_number') }}"
                                    class="w-full border-gray-300 rounded"
                                    required
                                >

                                @error('order_number')
                                    <p class="text-red-600 text-sm mt-1">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block font-medium">
                                    Número de Série (SN) *
                                </label>

                                <input
                                    type="text"
                                    name="serial_number"
                                    value="{{ old('serial_number') }}"
                                    class="w-full border-gray-300 rounded"
                                    required
                                >

                                @error('serial_number')
                                    <p class="text-red-600 text-sm mt-1">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <div class="mb-4">
                                <label class="block font-medium">
                                    Setor responsável *
                                </label>

                                <select
                                    name="sector_id"
                                    class="w-full border-gray-300 rounded"
                                    required
                                >
                                    <option value="">
                                        Selecione um setor
                                    </option>

                                    @foreach ($sectors as $sector)
                                        <option
                                            value="{{ $sector->id }}"
                                            @selected(old('sector_id') == $sector->id)
                                        >
                                            {{ $sector->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('sector_id')
                                    <p class="text-red-600 text-sm mt-1">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block font-medium">
                                    Prioridade *
                                </label>

                                <select
                                    name="priority"
                                    class="w-full border-gray-300 rounded"
                                    required
                                >
                                    <option value="low" @selected(old('priority') === 'low')>
                                        Baixa
                                    </option>

                                    <option value="medium" @selected(old('priority', 'medium') === 'medium')>
                                        Média
                                    </option>

                                    <option value="high" @selected(old('priority') === 'high')>
                                        Alta
                                    </option>

                                    <option value="critical" @selected(old('priority') === 'critical')>
                                        Crítica
                                    </option>
                                </select>

                                @error('priority')
                                    <p class="text-red-600 text-sm mt-1">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>

                        <div class="mb-6">
                            <label class="block font-medium">
                                Descrição *
                            </label>

                            <textarea
                                name="description"
                                rows="6"
                                class="w-full border-gray-300 rounded"
                                required
                            >{{ old('description') }}</textarea>

                            @error('description')
                                <p class="text-red-600 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex justify-end gap-3">

                            <a
                                href="{{ route('occurrences.index') }}"
                                class="px-4 py-2 bg-gray-200 rounded"
                            >
                                Cancelar
                            </a>

                            <button
                                type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded"
                            >
                                Abrir ocorrência
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</x-app-layout>