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
                class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
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
                @php
                    $activeFilters = collect([
                        request('order_number'), request('serial_number'),
                        request('inspection_date'), request('status'), request('created_by'),
                    ])->filter(fn ($value) => filled($value))->count();
                @endphp

                <div x-data="{ filtersOpen: {{ $activeFilters > 0 ? 'true' : 'false' }} }"
                    class="border-b border-slate-200 bg-slate-50/70 p-4 sm:p-6">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <div>
                            <h3 class="text-sm font-semibold text-slate-900">Filtros de busca</h3>
                            <p class="mt-0.5 text-xs text-slate-500">Refine a lista de inspeções de totens.</p>
                        </div>

                        <button type="button" @click="filtersOpen = ! filtersOpen" :aria-expanded="filtersOpen"
                            class="inline-flex items-center gap-2 rounded-xl border border-indigo-200 bg-white px-4 py-2.5 text-sm font-semibold text-indigo-700 shadow-sm transition hover:border-indigo-300 hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.75 5.25h16.5M6.75 12h10.5m-7.5 6.75h4.5" />
                            </svg>
                            <span x-text="filtersOpen ? 'Ocultar filtros' : 'Filtrar inspeções'"></span>
                            @if ($activeFilters > 0)
                                <span class="inline-flex h-5 min-w-5 items-center justify-center rounded-full bg-indigo-600 px-1.5 text-xs text-white">{{ $activeFilters }}</span>
                            @endif
                            <svg class="h-4 w-4 transition-transform" :class="filtersOpen && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6" />
                            </svg>
                        </button>
                    </div>

                    <form
                        x-show="filtersOpen"
                        x-transition
                        method="GET"
                        action="{{ route('totem-inspections.index') }}"
                        class="mt-5 grid grid-cols-1 gap-4 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm md:grid-cols-2 lg:grid-cols-6 sm:p-5">

                        {{-- Pedido --}}
                        <div>
                            <label
                                for="order_number"
                                class="block text-sm font-medium text-gray-700 mb-1">
                                Pedido
                            </label>

                            <input
                                id="order_number"
                                type="text"
                                name="order_number"
                                value="{{ request('order_number') }}"
                                placeholder="Buscar pedido"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>


                        {{-- Serial --}}
                        <div>
                            <label
                                for="serial_number"
                                class="block text-sm font-medium text-gray-700 mb-1">
                                Serial
                            </label>

                            <input
                                id="serial_number"
                                type="text"
                                name="serial_number"
                                value="{{ request('serial_number') }}"
                                placeholder="Buscar serial"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>


                        {{-- Data da inspeção --}}
                        <div>
                            <label
                                for="inspection_date"
                                class="block text-sm font-medium text-gray-700 mb-1">
                                Data
                            </label>

                            <input
                                id="inspection_date"
                                type="date"
                                name="inspection_date"
                                value="{{ request('inspection_date') }}"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>


                        {{-- Status --}}
                        <div>
                            <label
                                for="status"
                                class="block text-sm font-medium text-gray-700 mb-1">
                                Status
                            </label>

                            <select
                                id="status"
                                name="status"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">
                                    Todos
                                </option>

                                <option
                                    value="draft"
                                    {{ request('status') === 'draft' ? 'selected' : '' }}>
                                    Em preenchimento
                                </option>

                                <option
                                    value="finalized"
                                    {{ request('status') === 'finalized' ? 'selected' : '' }}>
                                    Finalizado
                                </option>

                            </select>
                        </div>


                        {{-- Usuário --}}
                        @if (auth()->user()->role === 'super_admin')

                        <div>
                            <label
                                for="created_by"
                                class="block text-sm font-medium text-gray-700 mb-1">
                                Usuário
                            </label>

                            <select
                                id="created_by"
                                name="created_by"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">
                                    Todos
                                </option>

                                @foreach ($users as $user)

                                <option
                                    value="{{ $user->id }}"
                                    {{ (string) request('created_by') === (string) $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>

                                @endforeach

                            </select>
                        </div>

                        @endif


                        {{-- Botões --}}
                        <div class="flex items-end gap-2">

                            <button
                                type="submit"
                                class="inline-flex flex-1 items-center justify-center rounded-xl bg-indigo-600 px-4 py-2.5 font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Filtrar
                            </button>

                            <a
                                href="{{ route('totem-inspections.index') }}"
                                class="inline-flex flex-1 items-center justify-center rounded-xl border border-slate-300 bg-white px-4 py-2.5 font-semibold text-slate-700 transition hover:bg-slate-50">
                                Limpar
                            </a>

                        </div>

                    </form>

                </div>
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
                                        class="inline-flex rounded-lg bg-indigo-50 px-3 py-1.5 text-sm font-semibold text-indigo-700 transition hover:bg-indigo-100">
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
