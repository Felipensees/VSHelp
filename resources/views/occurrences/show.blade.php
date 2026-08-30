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
                class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                Voltar
            </a>

        </div>
    </x-slot>

    <div class="py-12">

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Mensagem de sucesso --}}
            @if (session('success'))
            <div class="p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
            @endif

            {{-- Mensagem de erro --}}
            @if (session('error'))
            <div class="p-4 bg-red-100 text-red-800 rounded">
                {{ session('error') }}
            </div>
            @endif


            {{-- Informações principais --}}
            <div class="bg-white shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 mb-6">

                        <div>

                            <h3 class="text-xl font-semibold text-gray-900">
                                {{ $occurrence->title }}
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Criada em
                                {{ $occurrence->created_at->format('d/m/Y \à\s H:i') }}
                            </p>

                        </div>

                        <div class="flex flex-wrap gap-2">

                            {{-- Prioridade --}}
                            @switch($occurrence->priority)

                            @case('low')
                            <span class="px-3 py-1 text-sm font-medium bg-gray-100 text-gray-700 rounded">
                                Prioridade Baixa
                            </span>
                            @break

                            @case('medium')
                            <span class="px-3 py-1 text-sm font-medium bg-blue-100 text-blue-700 rounded">
                                Prioridade Média
                            </span>
                            @break

                            @case('high')
                            <span class="px-3 py-1 text-sm font-medium bg-orange-100 text-orange-700 rounded">
                                Prioridade Alta
                            </span>
                            @break

                            @case('critical')
                            <span class="px-3 py-1 text-sm font-medium bg-red-100 text-red-700 rounded">
                                Prioridade Crítica
                            </span>
                            @break

                            @endswitch


                            {{-- Status --}}
                            @switch($occurrence->status)

                            @case('open')
                            <span class="px-3 py-1 text-sm font-medium bg-blue-100 text-blue-700 rounded">
                                Aberta
                            </span>
                            @break

                            @case('in_progress')
                            <span class="px-3 py-1 text-sm font-medium bg-yellow-100 text-yellow-700 rounded">
                                Em andamento
                            </span>
                            @break

                            @case('resolved')
                            <span class="px-3 py-1 text-sm font-medium bg-green-100 text-green-700 rounded">
                                Resolvida
                            </span>
                            @break

                            @case('closed')
                            <span class="px-3 py-1 text-sm font-medium bg-gray-100 text-gray-700 rounded">
                                Encerrada
                            </span>
                            @break

                            @endswitch

                        </div>

                    </div>


                    {{-- Descrição --}}
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

                        {{-- Modelo --}}
                        <div>

                            <p class="text-sm text-gray-500">
                                Modelo
                            </p>

                            <p class="font-medium mt-1">
                                ID {{ $occurrence->totem_model_id }}
                            </p>

                        </div>


                        {{-- Pedido --}}
                        <div>

                            <p class="text-sm text-gray-500">
                                Pedido
                            </p>

                            <p class="font-medium mt-1">
                                {{ $occurrence->order_number }}
                            </p>

                        </div>


                        {{-- Número de Série --}}
                        <div>

                            <p class="text-sm text-gray-500">
                                Número de Série
                            </p>

                            <p class="font-medium mt-1">
                                {{ $occurrence->serial_number }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Atendimento --}}
            <div class="bg-white shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <h3 class="text-lg font-semibold mb-4">
                        Atendimento
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        {{-- Criador --}}
                        <div>

                            <p class="text-sm text-gray-500">
                                Aberto por
                            </p>

                            <p class="font-medium mt-1">
                                {{ $occurrence->creator?->name ?? '-' }}
                            </p>

                        </div>


                        {{-- Setor --}}
                        <div>

                            <p class="text-sm text-gray-500">
                                Setor responsável
                            </p>

                            <p class="font-medium mt-1">
                                {{ $occurrence->sector?->name ?? '-' }}
                            </p>

                        </div>


                        {{-- Responsável --}}
                        <div>

                            <p class="text-sm text-gray-500">
                                Responsável
                            </p>

                            <p class="font-medium mt-1">
                                {{ $occurrence->assignedUser?->name ?? 'Não atribuído' }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Ações da ocorrência --}}
            <div class="bg-white shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <h3 class="text-lg font-semibold mb-4">
                        Ações
                    </h3>


                    <div class="flex flex-wrap gap-3">

                        {{-- OPEN -> IN_PROGRESS --}}
                        @if (
                        $occurrence->status === 'open'
                        && (
                        auth()->user()->role === 'super_admin'
                        || $occurrence->assigned_user_id === auth()->id()
                        )
                        )

                        <form
                            method="POST"
                            action="{{ route('occurrences.start', $occurrence) }}">

                            @csrf
                            @method('PATCH')

                            <button
                                type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                Iniciar atendimento
                            </button>

                        </form>

                        @endif


                        {{-- IN_PROGRESS -> RESOLVED --}}
                        @if (
                        $occurrence->status === 'in_progress'
                        && (
                        auth()->user()->role === 'super_admin'
                        || $occurrence->assigned_user_id === auth()->id()
                        )
                        )

                        <form
                            method="POST"
                            action="{{ route('occurrences.resolve', $occurrence) }}">

                            @csrf
                            @method('PATCH')

                            <button
                                type="submit"
                                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                Marcar como resolvida
                            </button>

                        </form>

                        @endif


                        {{-- RESOLVED -> CLOSED --}}
                        @if (
                        $occurrence->status === 'resolved'
                        && (
                        auth()->user()->role === 'super_admin'
                        || $occurrence->created_by === auth()->id()
                        )
                        )

                        <form
                            method="POST"
                            action="{{ route('occurrences.close', $occurrence) }}">

                            @csrf
                            @method('PATCH')

                            <button
                                type="submit"
                                class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-900"
                                onclick="return confirm('Deseja realmente encerrar esta ocorrência?')">
                                Encerrar ocorrência
                            </button>

                        </form>

                        @endif


                        {{-- Nenhuma ação disponível --}}
                        @if (
                        $occurrence->status === 'closed'
                        || (
                        auth()->user()->role !== 'super_admin'
                        && $occurrence->assigned_user_id !== auth()->id()
                        && $occurrence->created_by !== auth()->id()
                        )
                        )

                        <span class="text-sm text-gray-500 self-center">
                            Nenhuma ação disponível.
                        </span>

                        @endif

                    </div>

                    {{-- Tempo de Atendimento --}}
                    <div class="bg-white shadow-sm sm:rounded-lg">

                        <div class="p-6">

                            <div class="flex items-center justify-between mb-6">

                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">
                                        Tempo de Atendimento
                                    </h3>

                                    <p class="text-sm text-gray-500 mt-1">
                                        Acompanhe as principais datas desta ocorrência.
                                    </p>
                                </div>

                            </div>


                            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                                {{-- Aberta --}}
                                <div class="border border-gray-200 rounded-lg p-4">

                                    <p class="text-sm text-gray-500">
                                        Ocorrência aberta
                                    </p>

                                    <p class="font-semibold text-gray-900 mt-2">
                                        {{ $occurrence->created_at->format('d/m/Y') }}
                                    </p>

                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ $occurrence->created_at->format('H:i:s') }}
                                    </p>

                                </div>


                                {{-- Início --}}
                                <div class="border border-gray-200 rounded-lg p-4">

                                    <p class="text-sm text-gray-500">
                                        Início do atendimento
                                    </p>

                                    @if ($occurrence->started_at)

                                    <p class="font-semibold text-gray-900 mt-2">
                                        {{ $occurrence->started_at->format('d/m/Y') }}
                                    </p>

                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ $occurrence->started_at->format('H:i:s') }}
                                    </p>

                                    @else

                                    <p class="text-sm text-gray-400 mt-2">
                                        Ainda não iniciado
                                    </p>

                                    @endif

                                </div>


                                {{-- Resolvida --}}
                                <div class="border border-gray-200 rounded-lg p-4">

                                    <p class="text-sm text-gray-500">
                                        Resolução
                                    </p>

                                    @if ($occurrence->resolved_at)

                                    <p class="font-semibold text-gray-900 mt-2">
                                        {{ $occurrence->resolved_at->format('d/m/Y') }}
                                    </p>

                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ $occurrence->resolved_at->format('H:i:s') }}
                                    </p>

                                    @else

                                    <p class="text-sm text-gray-400 mt-2">
                                        Ainda não resolvida
                                    </p>

                                    @endif

                                </div>


                                {{-- Encerrada --}}
                                <div class="border border-gray-200 rounded-lg p-4">

                                    <p class="text-sm text-gray-500">
                                        Encerramento
                                    </p>

                                    @if ($occurrence->closed_at)

                                    <p class="font-semibold text-gray-900 mt-2">
                                        {{ $occurrence->closed_at->format('d/m/Y') }}
                                    </p>

                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ $occurrence->closed_at->format('H:i:s') }}
                                    </p>

                                    @else

                                    <p class="text-sm text-gray-400 mt-2">
                                        Ainda não encerrada
                                    </p>

                                    @endif

                                </div>
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <p class="text-sm text-gray-500">
                                        Tempo total
                                    </p>

                                    @if ($occurrence->total_duration)
                                    <p class="font-semibold text-gray-900 mt-2">
                                        {{ $occurrence->total_duration }}
                                    </p>
                                    @else
                                    <p class="text-sm text-gray-400 mt-2">
                                        Ocorrência ainda não encerrada
                                    </p>
                                    @endif
                                </div>
                            </div>

                        </div>

                    </div>
                    {{-- Ajuda de acordo com status --}}
                    <div class="mt-4 text-sm text-gray-500">

                        @switch($occurrence->status)

                        @case('open')
                        <p>
                            A ocorrência está aguardando o início do atendimento pelo responsável.
                        </p>
                        @break

                        @case('in_progress')
                        <p>
                            O responsável está trabalhando na resolução desta ocorrência.
                        </p>
                        @break

                        @case('resolved')
                        <p>
                            A ocorrência foi marcada como resolvida e aguarda encerramento.
                        </p>
                        @break

                        @case('closed')
                        <p>
                            Esta ocorrência está encerrada.
                        </p>
                        @break

                        @endswitch

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>