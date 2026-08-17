<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Setores
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">

                    <div class="flex justify-between items-center mb-6">

                        <h3 class="text-lg font-semibold">
                            Lista de setores
                        </h3>

                        <a
                            href="{{ route('sectors.create') }}"
                            class="px-4 py-2 bg-blue-600 text-white rounded">
                            Novo setor
                        </a>

                    </div>

                    @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                    @endif
                    @if (session('error'))
                    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                        {{ session('error') }}
                    </div>
                    @endif
                    <table class="w-full">

                        <thead>
                            <tr class="border-b">
                                <th class="text-left p-3">Nome</th>
                                <th class="text-left p-3">Descrição</th>
                                <th class="text-left p-3">Status</th>
                                <th class="text-right p-3">Ações</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($sectors as $sector)

                            <tr class="border-b">

                                <td class="p-3">
                                    {{ $sector->name }}
                                </td>

                                <td class="p-3">
                                    {{ $sector->description ?? '-' }}
                                </td>

                                <td class="p-3">
                                    {{ $sector->active ? 'Ativo' : 'Inativo' }}
                                </td>

                                <td class="p-3 text-right">

                                    <a
                                        href="{{ route('sectors.edit', $sector) }}"
                                        class="text-blue-600">
                                        Editar
                                    </a>
                                    <form
                                        method="POST"
                                        action="{{ route('sectors.destroy', $sector) }}"
                                        onsubmit="return confirm('Deseja realmente excluir este setor?')">
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="text-red-600 hover:underline">
                                            Excluir
                                        </button>
                                    </form>
                                </td>

                            </tr>

                            @empty

                            <tr>
                                <td colspan="4" class="p-6 text-center">
                                    Nenhum setor cadastrado.
                                </td>
                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>