<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">

            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
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
                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
            >
                Novo Totem
            </a>

        </div>
    </x-slot>


    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">

                @if ($totemInspections->isEmpty())

                    <div class="p-8 text-center">

                        <p class="text-gray-500">
                            Nenhuma inspeção cadastrada.
                        </p>

                    </div>

                @else

                    <div class="overflow-x-auto">

                        <table class="min-w-full divide-y divide-gray-200">

                            <thead class="bg-gray-50">

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

                                    <tr>

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
                                                class="text-indigo-600 hover:text-indigo-900 text-sm font-medium"
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