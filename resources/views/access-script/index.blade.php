<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gerador de Acesso
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Dados do Totem
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Preencha os dados para gerar a mensagem pronta para envio.
                        </p>
                    </div>
                    <div>
                        <label
                            for="implantacao"
                            class="block text-sm font-medium text-gray-700 mb-1">
                            Implantação
                        </label>

                        <select
                            id="implantacao"
                            class="w-full rounded-md border-gray-300 shadow-sm">
                            <option value="">Selecione...</option>
                            <option value="FÁBRICA">Fábrica</option>
                            <option value="CLIENTE">Cliente</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Cliente
                            </label>

                            <input
                                id="cliente"
                                type="text"
                                class="w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Pedido
                            </label>

                            <input
                                id="pedido"
                                type="text"
                                class="w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Vendedor
                            </label>

                            <input
                                id="vendedor"
                                type="text"
                                class="w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Serial
                            </label>

                            <input
                                id="serial"
                                type="text"
                                class="w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                TeamViewer
                            </label>

                            <input
                                id="teamviewer"
                                type="text"
                                class="w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label
                                for="impressora"
                                class="block text-sm font-medium text-gray-700 mb-1">
                                Impressora
                            </label>

                            <select
                                id="impressora"
                                class="w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">Selecione...</option>
                                <option value="TM-T88VII">TM-T88VII</option>
                                <option value="TM-T20X">TM-T20X</option>
                            </select>
                        </div>

                    </div>

                    <div class="mt-6">
                        <button
                            type="button"
                            onclick="gerarTexto()"
                            class="px-5 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                            Gerar texto
                        </button>
                    </div>

                </div>
            </div>


            <div
                id="resultado-container"
                class="bg-white shadow-sm sm:rounded-lg mt-6 hidden">
                <div class="p-6">

                    <div class="flex items-center justify-between mb-4">

                        <h3 class="text-lg font-semibold text-gray-900">
                            Mensagem gerada
                        </h3>

                        <button
                            type="button"
                            onclick="copiarTexto()"
                            class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                            Copiar
                        </button>

                    </div>

                    <textarea
                        id="resultado"
                        rows="9"
                        readonly
                        class="w-full rounded-md border-gray-300 bg-gray-50 shadow-sm"></textarea>

                    <p
                        id="copiado"
                        class="text-sm text-green-600 mt-2 hidden">
                        Texto copiado!
                    </p>

                </div>
            </div>

        </div>
    </div>


    <script>
    function gerarTexto() {

        const implantacao = document.getElementById('implantacao').value;
        const cliente = document.getElementById('cliente').value;
        const pedido = document.getElementById('pedido').value;
        const vendedor = document.getElementById('vendedor').value;
        const serial = document.getElementById('serial').value;
        const teamviewer = document.getElementById('teamviewer').value;
        const impressora = document.getElementById('impressora').value;

        if (!implantacao) {
            alert('Selecione se a implantação é em Fábrica ou Cliente.');
            return;
        }

        if (!impressora) {
            alert('Selecione a impressora.');
            return;
        }

        const texto =
`Bom dia!
Segue acesso (IMPLANTAÇÃO EM ${implantacao})

Cliente: ${cliente}
Pedido: ${pedido}
Vendedor: ${vendedor}
Serial: ${serial} - TeamViewer: ${teamviewer}
Impressora: ${impressora}`;

        document.getElementById('resultado').value = texto;

        document
            .getElementById('resultado-container')
            .classList.remove('hidden');
    }

    function copiarTexto() {

        const resultado = document.getElementById('resultado');

        navigator.clipboard.writeText(resultado.value);

        const mensagem = document.getElementById('copiado');

        mensagem.classList.remove('hidden');

        setTimeout(() => {
            mensagem.classList.add('hidden');
        }, 2000);
    }
</script>

</x-app-layout>