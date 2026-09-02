<x-app-layout>

    <x-slot name="header">
        <p class="text-sm font-semibold uppercase tracking-widest text-indigo-600">Inspeções</p>
        <h2 class="mt-1 text-2xl font-bold text-slate-900">
            Novo Totem
        </h2>
    </x-slot>

    <div class="py-10 sm:py-14">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="overflow-hidden border border-slate-200 bg-white shadow-sm sm:rounded-2xl">

                <div class="p-6 sm:p-8">

                    <h3 class="text-lg font-semibold text-gray-900">
                        Identificação do Totem
                    </h3>

                    <p class="text-sm text-gray-500 mt-1 mb-6">
                        Informe o pedido e o número de série antes de iniciar a inspeção.
                    </p>

                    <form
                        method="POST"
                        action="{{ route('totem-inspections.store') }}">
                        @csrf

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
                                value="{{ old('order_number') }}"
                                required
                                autocomplete="off"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                        </div>

                        <div class="mb-6">
                            <label
                                for="serial_number"
                                class="block text-sm font-medium text-gray-700 mb-1">
                                Serial Number
                            </label>

                            <input
                                id="serial_number"
                                type="text"
                                name="serial_number"
                                value="{{ old('serial_number') }}"
                                required
                                placeholder="Ex.: 12345"
                                class="w-full rounded-lg border-slate-300 px-4 py-3 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                            @error('serial_number')
                            <p class="text-sm text-red-600 mt-1">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="flex justify-end gap-3">

                            <a
                                href="{{ route('totem-inspections.index') }}"
                                class="rounded-lg border border-slate-300 px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                                Cancelar
                            </a>

                            <button
                                type="submit"
                                class="rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Iniciar inspeção
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>
{{--
<script>
    const pedidoInput = document.getElementById('order_number');
    const pdfStatus = document.getElementById('pdf-status');

    let timer;

    pedidoInput.addEventListener('input', function () {

        clearTimeout(timer);

        const pedido = this.value.trim();

        pdfStatus.innerHTML = '';
        pdfStatus.classList.add('hidden');

        if (pedido.length < 2) {
            return;
        }

        timer = setTimeout(() => {
            buscarPdf(pedido);
        }, 600);
    });

    async function buscarPdf(pedido) {

        pdfStatus.classList.remove('hidden');

        pdfStatus.innerHTML = `
            <span class="text-sm text-gray-500">
                Buscando PDF...
            </span>
        `;

        try {

            const url =
                "{{ url('/totens/buscar-pdf') }}/" +
                encodeURIComponent(pedido);

            const response = await fetch(url);

            if (!response.ok) {
                throw new Error('Erro ao consultar PDF');
            }

            const data = await response.json();

            if (!data.found) {

                pdfStatus.innerHTML = `
                    <div class="text-sm text-yellow-700">
                        Nenhum PDF encontrado para o pedido
                        <strong>${escapeHtml(pedido)}</strong>.
                    </div>
                `;

                return;
            }

            pdfStatus.innerHTML = `
                <div class="flex items-center gap-3">

                    <span class="text-sm font-medium text-green-700">
                        PDF encontrado
                    </span>

                    <a
                        href="${data.file.web_view_link}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="text-sm font-medium text-indigo-600 hover:text-indigo-800"
                    >
                        Abrir PDF
                    </a>

                </div>
            `;

        } catch (error) {

            pdfStatus.innerHTML = `
                <span class="text-sm text-red-600">
                    Não foi possível consultar o PDF.
                </span>
            `;

            console.error(error);
        }
    }

    function escapeHtml(value) {

        const div = document.createElement('div');

        div.textContent = value;

        return div.innerHTML;
    }
</script>
--}}
</x-app-layout>
