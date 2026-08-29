<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">

            <div>
                <p class="text-sm font-semibold uppercase tracking-widest text-indigo-600">Inspeções</p>
                <h2 class="mt-1 text-2xl font-bold text-slate-900">
                    Inspeções de Totens
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    @if (auth()->user()->role === 'super_admin')
                        Visualize todas as inspeções cadastradas.
                    @else
                        Visualize suas inspeções cadastradas.
                    @endif
                </p>
            </div>

            <a
                href="{{ route('totem-inspections.create') }}"
                class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
            >
                <span class="text-lg leading-none">+</span> Novo Totem
            </a>

        </div>
    </x-slot>


    <div class="py-10 sm:py-14">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="overflow-hidden border border-slate-200 bg-white shadow-sm sm:rounded-2xl">

                @if ($totemInspections->isEmpty())

                    <div class="px-6 py-16 text-center">
                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-50 text-2xl text-indigo-600">▣</div>
                        <h3 class="mt-4 font-semibold text-slate-900">Nenhuma inspeção encontrada</h3>
                        <p class="mt-1 text-sm text-slate-500">
                            Nenhuma inspeção cadastrada.
                        </p>

                    </div>

                @else

                    <div class="overflow-x-auto">

                        <table class="min-w-full divide-y divide-gray-200">

                            <thead class="bg-slate-50">

                                <tr>

                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        #
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Pedido
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Serial
                                    </th>

                                    @if (auth()->user()->role === 'super_admin')

                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                            Responsável
                                        </th>

                                    @endif

                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Status
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Criado em
                                    </th>

                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">
                                        Ações
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="bg-white divide-y divide-gray-200">

                                @foreach ($totemInspections as $inspection)

                                    <tr class="transition hover:bg-slate-50/80">

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            #{{ $inspection->id }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">

                                            <span class="text-sm font-medium text-gray-900">
                                                {{ $inspection->order_number }}
                                            </span>

                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">

                                            <span class="text-sm text-gray-700">
                                                {{ $inspection->serial_number }}
                                            </span>

                                        </td>

                                        @if (auth()->user()->role === 'super_admin')

                                            <td class="px-6 py-4 whitespace-nowrap">

                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $inspection->creator->name }}
                                                </div>

                                                <div class="text-xs text-gray-500">
                                                    {{ $inspection->creator->email }}
                                                </div>

                                            </td>

                                        @endif

                                        <td class="px-6 py-4 whitespace-nowrap">

                                            @if ($inspection->status === 'draft')

                                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    Em preenchimento
                                                </span>

                                            @else

                                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    Finalizado
                                                </span>

                                            @endif

                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $inspection->created_at->format('d/m/Y H:i') }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-right">

                                            <a
                                                href="{{ route('totem-inspections.show', $inspection) }}"
                                                class="inline-flex rounded-lg bg-indigo-50 px-3 py-1.5 text-sm font-semibold text-indigo-700 transition hover:bg-indigo-100"
                                            >
                                                Visualizar
                                            </a>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>


                    <div class="px-6 py-4 border-t border-gray-200">

                        {{ $totemInspections->links() }}

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>
