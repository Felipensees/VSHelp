<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-widest text-indigo-600">Checklist</p>
                <h2 class="mt-1 text-2xl font-bold text-slate-900">
                    Inspeção do Totem
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Pedido {{ $totemInspection->order_number }}
                    •
                    SN {{ $totemInspection->serial_number }}
                </p>
            </div>
            <a
                href="{{ route('totem-inspections.index') }}"
                class="inline-flex rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                ← Voltar
            </a>

        </div>
    </x-slot>

    <div class="py-10 sm:py-14">

        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Informações --}}
            <div class="overflow-hidden border border-slate-200 bg-white shadow-sm sm:rounded-2xl">
                @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
                @endif

                @if (session('error'))
                <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
                @endif

                <div class="p-6 sm:p-8">

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div>
                            <p class="text-sm text-gray-500">
                                Pedido
                            </p>

                            <p class="font-semibold text-gray-900 mt-1">
                                {{ $totemInspection->order_number }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Serial Number
                            </p>

                            <p class="font-semibold text-gray-900 mt-1">
                                {{ $totemInspection->serial_number }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">
                                Responsável
                            </p>

                            <p class="font-semibold text-gray-900 mt-1">
                                {{ $totemInspection->creator->name }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">
                                Status
                            </p>
                            <div class="mt-1">

                                @if ($totemInspection->status === 'draft')

                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    Em preenchimento
                                </span>

                                @else

                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Finalizado
                                </span>
                                @endif

                                @php
                                $canEdit =
                                $totemInspection->status === 'draft'
                                || auth()->user()->role === 'super_admin';
                                @endphp
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- Checklist --}}
            <div class="overflow-hidden border border-slate-200 bg-white shadow-sm sm:rounded-2xl">

                <div class="p-6 sm:p-8">

                    <div class="mb-8">

                        <h3 class="text-lg font-semibold text-gray-900">
                            Checklist de Inspeção
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Marque OK ou N/A para cada item verificado.
                        </p>

                    </div>


                    <form
                        method="POST"
                        action="{{ route('totem-inspections.update', $totemInspection) }}">
                        @csrf
                        @method('PUT')

                        <div class="space-y-10">

                            @foreach ($sections as $section)

                            <div class="rounded-xl border border-slate-200 p-5 sm:p-6">

                                <div class="border-b border-slate-200 pb-3 mb-2">

                                    <h4 class="font-semibold text-gray-900">
                                        {{ $section->name }}
                                    </h4>

                                </div>


                                <div class="divide-y divide-gray-100">

                                    @foreach ($section->items as $item)

                                    <div
                                        class="py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4 transition hover:bg-slate-50">

                                        <div>

                                            <p class="text-sm font-medium text-gray-800">
                                                {{ $item->name }}
                                            </p>

                                        </div>


                                        <div class="flex items-center gap-6">

                                            <label class="inline-flex items-center gap-2 cursor-pointer">

                                                <input
                                                    type="radio"
                                                    name="answers[{{ $item->id }}]"
                                                    value="ok"
                                                    {{ ($savedAnswers[$item->id] ?? null) === 'ok' ? 'checked' : '' }}
                                                    {{ ! $canEdit ? 'disabled' : '' }}
                                                    class="border-gray-300 text-indigo-600 focus:ring-indigo-500">

                                                <span class="text-sm font-medium text-gray-700">
                                                    OK
                                                </span>

                                            </label>


                                            <label class="inline-flex items-center gap-2 cursor-pointer">

                                                <input
                                                    type="radio"
                                                    name="answers[{{ $item->id }}]"
                                                    value="na"
                                                    {{ ($savedAnswers[$item->id] ?? null) === 'na' ? 'checked' : '' }}
                                                    {{ ! $canEdit ? 'disabled' : '' }}
                                                    class="border-gray-300 text-indigo-600 focus:ring-indigo-500">

                                                <span class="text-sm font-medium text-gray-700">
                                                    N/A
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="mt-10 pt-6 border-t border-gray-200 flex flex-col sm:flex-row justify-end gap-3">

                            @if ($totemInspection->status === 'draft')

                            <button
                                type="submit"
                                name="action"
                                value="draft"
                                class="rounded-lg border border-slate-300 px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                                Salvar rascunho
                            </button>

                            <button
                                type="submit"
                                name="action"
                                value="finalize"
                                onclick="return confirm('Tem certeza que deseja finalizar esta inspeção? Depois disso ela não poderá mais ser alterada por você.')"
                                class="rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">
                                Finalizar inspeção
                            </button>

                            @elseif (auth()->user()->role === 'super_admin')

                            <button
                                type="submit"
                                name="action"
                                value="draft"
                                class="rounded-lg border border-slate-300 px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                                Salvar alterações
                            </button>

                            @endif

                        </div>
                    </form>

                    @if ($totemInspection->status === 'draft')

                    @endif

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
