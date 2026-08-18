<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Ocorrência #{{ $occurrence->id }}
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    {{ $occurrence->title }}
                </p>
            </div>

            <a
                href="{{ route('occurrences.index') }}"
                class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300"
            >
                Voltar
            </a>
        </div>
    </x-slot>

    <div class="py-12">

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Informações principais --}}
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <div class="flex items-start justify-between gap-4 mb-6">

                        <div>
                            <h3 class="text-xl font-semibold text-gray-900">
                                {{ $occurrence->title }}
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Criada em
                                {{ $occurrence->created_at->format('d/m/Y \à\s H:i') }}
                            </p>
                        </div>

                        <div class="flex gap-2">

                            {{-- Prioridade --}}
                            @switch($occurrence->priority)

                                @case('low')
                                    <span class="px-3 py-1 text-sm bg-gray-100 text-gray-700 rounded">
                                        Prioridade Baixa
                                    </span>
                                    @break

                                @case('medium')
                                    <span class="px-3 py-1 text-sm bg-blue-100 text-blue-700 rounded">
                                        Prioridade Média
                                    </span>
                                    @break

                                @case('high')
                                    <span class="px-3 py-1 text-sm bg-orange-100 text-orange-700 rounded">
                                        Prioridade Alta
                                    </span>
                                    @break

                                @case('critical')
                                    <span class="px-3 py-1 text-sm bg-red-100 text-red-700 rounded">
                                        Prioridade Crítica
                                    </span>
                                    @break

                            @endswitch

                            {{-- Status --}}
                            @switch($occurrence->status)

                                @case('open')
                                    <span class="px-3 py-1 text-sm bg-blue-100 text-blue-700 rounded">
                                        Aberta
                                    </span>
                                    @break

                                @case('in_progress')
                                    <span class="px-3 py-1 text-sm bg-yellow-100 text-yellow-700 rounded">
                                        Em andamento
                                    </span>
                                    @break

                                @case('resolved')
                                    <span class="px-3 py-1 text-sm bg-green-100 text-green-700 rounded">
                                        Resolvida
                                    </span>
                                    @break

                                @case('closed')
                                    <span class="px-3 py-1 text-sm bg-gray-100 text-gray-700 rounded">
                                        Encerrada
                                    </span>
                                    @break

                            @endswitch

                        </div>
                    </div>

                    <div>
                        <h4 class="font-medium text-gray-900 mb-2">
                            Descrição
                        </h4>

                        <div class="bg-gray-50 rounded p-4 text-gray-700 whitespace-pre-line">
                            {{ $occurrence->description }}
                        </div>
                    </div>

                </div>
            </div>

            {{-- Dados do Totem --}}
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <h3 class="text-lg font-semibold mb-4">
                        Dados do Totem
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        <div>
                            <p class="text-sm text-gray-500">
                                Modelo
                            </p>

                            <p class="font-medium">
                                ID {{ $occurrence->totem_model_id }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Pedido
                            </p>

                            <p class="font-medium">
                                {{ $occurrence->order_number }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Número de Série
                            </p>

                            <p class="font-medium">
                                {{ $occurrence->serial_number }}
                            </p>
                        </div>

                    </div>

                </div>
            </div>

            {{-- Responsáveis --}}
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <h3 class="text-lg font-semibold mb-4">
                        Atendimento
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        <div>
                            <p class="text-sm text-gray-500">
                                Aberto por
                            </p>

                            <p class="font-medium">
                                {{ $occurrence->creator?->name ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Setor responsável
                            </p>

                            <p class="font-medium">
                                {{ $occurrence->sector?->name ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Responsável
                            </p>

                            <p class="font-medium">
                                {{ $occurrence->assignedUser?->name ?? 'Não atribuído' }}
                            </p>
                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>

</x-app-layout>