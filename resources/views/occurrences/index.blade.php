<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Ocorrências
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    @if (auth()->user()->role === 'super_admin')
                        Acompanhe todas as ocorrências do sistema.
                    @else
                        Acompanhe as ocorrências atribuídas a você.
                    @endif
                </p>
            </div>

            <a
                href="{{ route('occurrences.create') }}"
                class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition"
            >
                Nova ocorrência
            </a>

        </div>
    </x-slot>


    <div class="py-10">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Mensagens --}}
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 p-4 bg-red-100 border border-red-200 text-red-800 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif


            <div class="bg-white shadow-sm sm:rounded-xl overflow-hidden">

                {{-- Abas --}}
                <div class="border-b border-gray-200">

                    <nav class="flex px-6">

                        {{-- Em progresso --}}
                        <a
                            href="{{ route('occurrences.index', ['tab' => 'progress']) }}"
                            class="
                                relative px-4 py-4 text-sm font-medium transition
                                {{ $tab === 'progress'
                                    ? 'text-blue-600'
                                    : 'text-gray-500 hover:text-gray-700'
                                }}
                            "
                        >
                            Em progresso

                            @if ($tab === 'progress')
                                <span class="absolute bottom-0 left-0 right-0 h-0.5 bg-blue-600"></span>
                            @endif
                        </a>


                        {{-- Finalizadas --}}
                        <a
                            href="{{ route('occurrences.index', ['tab' => 'finished']) }}"
                            class="
                                relative px-4 py-4 text-sm font-medium transition
                                {{ $tab === 'finished'
                                    ? 'text-blue-600'
                                    : 'text-gray-500 hover:text-gray-700'
                                }}
                            "
                        >
                            Finalizadas

                            @if ($tab === 'finished')
                                <span class="absolute bottom-0 left-0 right-0 h-0.5 bg-blue-600"></span>
                            @endif
                        </a>

                    </nav>

                </div>


                {{-- Conteúdo --}}
                <div class="p-6">

                    {{-- Cabeçalho da aba --}}
                    <div class="mb-6">

                        @if ($tab === 'finished')

                            <h3 class="text-lg font-semibold text-gray-900">
                                Ocorrências finalizadas
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Ocorrências resolvidas ou encerradas.
                            </p>

                        @else

                            <h3 class="text-lg font-semibold text-gray-900">
                                Ocorrências em progresso
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Ocorrências abertas ou em atendimento.
                            </p>

                        @endif

                    </div>


                    {{-- Tabela --}}
                    <div class="overflow-x-auto">

                        <table class="w-full">

                            <thead>

                                <tr class="border-b border-gray-200 bg-gray-50">

                                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase">
                                        #
                                    </th>

                                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase">
                                        Ocorrência
                                    </th>

                                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase">
                                        Pedido / SN
                                    </th>

                                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase">
                                        Setor
                                    </th>

                                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase">
                                        Responsável
                                    </th>

                                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase">
                                        Prioridade
                                    </th>

                                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase">
                                        Status
                                    </th>

                                    <th class="text-right px-4 py-3 text-xs font-semibold text-gray-500 uppercase">
                                        Ações
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-gray-100">

                                @forelse ($occurrences as $occurrence)

                                    <tr class="hover:bg-gray-50 transition">

                                        {{-- ID --}}
                                        <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            #{{ $occurrence->id }}
                                        </td>


                                        {{-- Ocorrência --}}
                                        <td class="px-4 py-4">

                                            <p class="font-medium text-gray-900">
                                                {{ $occurrence->title }}
                                            </p>

                                            <p class="text-xs text-gray-500 mt-1">
                                                Criada em {{ $occurrence->created_at->format('d/m/Y H:i') }}
                                            </p>

                                        </td>


                                        {{-- Pedido / SN --}}
                                        <td class="px-4 py-4 whitespace-nowrap">

                                            <p class="text-sm text-gray-700">
                                                Pedido: {{ $occurrence->order_number }}
                                            </p>

                                            <p class="text-xs text-gray-500 mt-1">
                                                SN: {{ $occurrence->serial_number }}
                                            </p>

                                        </td>


                                        {{-- Setor --}}
                                        <td class="px-4 py-4 text-sm text-gray-700">
                                            {{ $occurrence->sector?->name ?? '-' }}
                                        </td>


                                        {{-- Responsável --}}
                                        <td class="px-4 py-4">

                                            @if ($occurrence->assignedUser)

                                                <div>
                                                    <p class="text-sm font-medium text-gray-700">
                                                        {{ $occurrence->assignedUser->name }}
                                                    </p>

                                                    <p class="text-xs text-gray-500">
                                                        {{ $occurrence->assignedUser->email }}
                                                    </p>
                                                </div>

                                            @else

                                                <span class="text-sm text-gray-500">
                                                    Não atribuído
                                                </span>

                                            @endif

                                        </td>


                                        {{-- Prioridade --}}
                                        <td class="px-4 py-4">

                                            @switch($occurrence->priority)

                                                @case('low')
                                                    <span class="inline-flex px-2.5 py-1 text-xs font-medium bg-gray-100 text-gray-700 rounded-full">
                                                        Baixa
                                                    </span>
                                                    @break

                                                @case('medium')
                                                    <span class="inline-flex px-2.5 py-1 text-xs font-medium bg-blue-100 text-blue-700 rounded-full">
                                                        Média
                                                    </span>
                                                    @break

                                                @case('high')
                                                    <span class="inline-flex px-2.5 py-1 text-xs font-medium bg-orange-100 text-orange-700 rounded-full">
                                                        Alta
                                                    </span>
                                                    @break

                                                @case('critical')
                                                    <span class="inline-flex px-2.5 py-1 text-xs font-medium bg-red-100 text-red-700 rounded-full">
                                                        Crítica
                                                    </span>
                                                    @break

                                            @endswitch

                                        </td>


                                        {{-- Status --}}
                                        <td class="px-4 py-4">

                                            @switch($occurrence->status)

                                                @case('open')
                                                    <span class="inline-flex px-2.5 py-1 text-xs font-medium bg-blue-100 text-blue-700 rounded-full">
                                                        Aberta
                                                    </span>
                                                    @break

                                                @case('in_progress')
                                                    <span class="inline-flex px-2.5 py-1 text-xs font-medium bg-yellow-100 text-yellow-700 rounded-full">
                                                        Em andamento
                                                    </span>
                                                    @break

                                                @case('resolved')
                                                    <span class="inline-flex px-2.5 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">
                                                        Resolvida
                                                    </span>
                                                    @break

                                                @case('closed')
                                                    <span class="inline-flex px-2.5 py-1 text-xs font-medium bg-gray-100 text-gray-700 rounded-full">
                                                        Encerrada
                                                    </span>
                                                    @break

                                            @endswitch

                                        </td>


                                        {{-- Ações --}}
                                        <td class="px-4 py-4 text-right whitespace-nowrap">

                                            <a
                                                href="{{ route('occurrences.show', $occurrence) }}"
                                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 hover:text-blue-800 hover:underline"
                                            >
                                                Visualizar
                                            </a>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td
                                            colspan="8"
                                            class="px-6 py-16 text-center"
                                        >

                                            <div class="max-w-sm mx-auto">

                                                @if ($tab === 'finished')

                                                    <p class="font-medium text-gray-700">
                                                        Nenhuma ocorrência finalizada
                                                    </p>

                                                    <p class="text-sm text-gray-500 mt-1">
                                                        As ocorrências resolvidas e encerradas aparecerão aqui.
                                                    </p>

                                                @else

                                                    <p class="font-medium text-gray-700">
                                                        Nenhuma ocorrência em progresso
                                                    </p>

                                                    <p class="text-sm text-gray-500 mt-1">
                                                        As ocorrências abertas ou em atendimento aparecerão aqui.
                                                    </p>

                                                @endif

                                            </div>

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>


                    {{-- Rodapé / Paginação --}}
                    <div class="mt-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-t border-gray-100 pt-6">

                        <p class="text-sm text-gray-500">

                            @if ($occurrences->total() > 0)

                                Mostrando
                                {{ $occurrences->firstItem() }}
                                até
                                {{ $occurrences->lastItem() }}
                                de
                                {{ $occurrences->total() }}
                                ocorrências

                            @else

                                Nenhuma ocorrência encontrada.

                            @endif

                        </p>


                        @if ($occurrences->hasPages())

                            <div>
                                {{ $occurrences->links() }}
                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>