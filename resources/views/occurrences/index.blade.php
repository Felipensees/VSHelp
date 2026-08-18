<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ocorrências
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    {{-- Cabeçalho --}}
                    <div class="flex justify-between items-center mb-6">

                        <div>
                            <h3 class="text-lg font-semibold">
                                @if (auth()->user()->role === 'super_admin')
                                    Todas as ocorrências
                                @else
                                    Minhas ocorrências
                                @endif
                            </h3>

                            <p class="text-sm text-gray-500">
                                Acompanhe as ocorrências registradas no sistema.
                            </p>
                        </div>

                        <a
                            href="{{ route('occurrences.create') }}"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                        >
                            Nova ocorrência
                        </a>

                    </div>

                    {{-- Mensagem de sucesso --}}
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Mensagem de erro --}}
                    @if (session('error'))
                        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- Tabela --}}
                    <div class="overflow-x-auto">

                        <table class="w-full">

                            <thead>
                                <tr class="border-b bg-gray-50">

                                    <th class="text-left p-3">
                                        #
                                    </th>

                                    <th class="text-left p-3">
                                        Título
                                    </th>

                                    <th class="text-left p-3">
                                        Pedido
                                    </th>

                                    <th class="text-left p-3">
                                        SN
                                    </th>

                                    <th class="text-left p-3">
                                        Setor
                                    </th>

                                    <th class="text-left p-3">
                                        Responsável
                                    </th>

                                    <th class="text-left p-3">
                                        Prioridade
                                    </th>

                                    <th class="text-left p-3">
                                        Status
                                    </th>

                                    <th class="text-right p-3">
                                        Ações
                                    </th>

                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($occurrences as $occurrence)

                                    <tr class="border-b hover:bg-gray-50">

                                        {{-- ID --}}
                                        <td class="p-3">
                                            #{{ $occurrence->id }}
                                        </td>

                                        {{-- Título --}}
                                        <td class="p-3 font-medium">
                                            {{ $occurrence->title }}
                                        </td>

                                        {{-- Pedido --}}
                                        <td class="p-3">
                                            {{ $occurrence->order_number }}
                                        </td>

                                        {{-- SN --}}
                                        <td class="p-3">
                                            {{ $occurrence->serial_number }}
                                        </td>

                                        {{-- Setor --}}
                                        <td class="p-3">
                                            {{ $occurrence->sector?->name ?? '-' }}
                                        </td>

                                        {{-- Responsável --}}
                                        <td class="p-3">
                                            {{ $occurrence->assignedUser?->name ?? 'Não atribuído' }}
                                        </td>

                                        {{-- Prioridade --}}
                                        <td class="p-3">

                                            @switch($occurrence->priority)

                                                @case('low')
                                                    <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-700 rounded">
                                                        Baixa
                                                    </span>
                                                    @break

                                                @case('medium')
                                                    <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-700 rounded">
                                                        Média
                                                    </span>
                                                    @break

                                                @case('high')
                                                    <span class="px-2 py-1 text-xs font-medium bg-orange-100 text-orange-700 rounded">
                                                        Alta
                                                    </span>
                                                    @break

                                                @case('critical')
                                                    <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-700 rounded">
                                                        Crítica
                                                    </span>
                                                    @break

                                            @endswitch

                                        </td>

                                        {{-- Status --}}
                                        <td class="p-3">

                                            @switch($occurrence->status)

                                                @case('open')
                                                    <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-700 rounded">
                                                        Aberta
                                                    </span>
                                                    @break

                                                @case('in_progress')
                                                    <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-700 rounded">
                                                        Em andamento
                                                    </span>
                                                    @break

                                                @case('resolved')
                                                    <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-700 rounded">
                                                        Resolvida
                                                    </span>
                                                    @break

                                                @case('closed')
                                                    <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-700 rounded">
                                                        Encerrada
                                                    </span>
                                                    @break

                                            @endswitch

                                        </td>

                                        {{-- Ações --}}
                                        <td class="p-3 text-right">

                                            <div class="flex justify-end gap-3">

                                                <a
                                                    href="{{ route('occurrences.show', $occurrence) }}"
                                                    class="text-blue-600 hover:underline"
                                                >
                                                    Visualizar
                                                </a>

                                                <a
                                                    href="{{ route('occurrences.edit', $occurrence) }}"
                                                    class="text-gray-600 hover:underline"
                                                >
                                                    Editar
                                                </a>

                                            </div>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td
                                            colspan="9"
                                            class="p-8 text-center text-gray-500"
                                        >
                                            Nenhuma ocorrência encontrada.
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>
            </div>

        </div>
    </div>

</x-app-layout>