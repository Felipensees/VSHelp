<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
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
                class="text-sm text-gray-600 hover:text-gray-900">
                Voltar
            </a>

        </div>
    </x-slot>

    <div class="py-12">

        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Informações --}}
            <div class="bg-white shadow-sm sm:rounded-lg">
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

                <div class="p-6">

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
            <div class="bg-white shadow-sm sm:rounded-lg">

                <div class="p-6">

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

                            <div>

                                <div class="border-b border-gray-200 pb-2 mb-4">

                                    <h4 class="font-semibold text-gray-900">
                                        {{ $section->name }}
                                    </h4>

                                </div>


                                <div class="divide-y divide-gray-100">

                                    @foreach ($section->items as $item)

                                    <div
                                        class="py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

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
                                class="px-5 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                                Salvar rascunho
                            </button>

                            <button
                                type="submit"
                                name="action"
                                value="finalize"
                                onclick="return confirm('Tem certeza que deseja finalizar esta inspeção? Depois disso ela não poderá mais ser alterada por você.')"
                                class="px-5 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                                Finalizar inspeção
                            </button>

                            @elseif (auth()->user()->role === 'super_admin')

                            <button
                                type="submit"
                                name="action"
                                value="draft"
                                class="px-5 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
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