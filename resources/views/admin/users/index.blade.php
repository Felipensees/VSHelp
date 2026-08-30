<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Usuários
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">
                            Lista de usuários
                        </h3>

                        <a
                            href="{{ route('users.create') }}"
                            class="px-4 py-2 bg-blue-600 text-white rounded">
                            Novo usuário
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
                                <th class="text-left p-3">E-mail</th>
                                <th class="text-left p-3">Setor</th>
                                <th class="text-left p-3">Perfil</th>
                                <th class="text-left p-3">Status</th>
                                <th class="text-right p-3">Ações</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($users as $user)

                            <tr class="border-b">

                                <td class="p-3">
                                    {{ $user->name }}
                                </td>

                                <td class="p-3">
                                    {{ $user->email }}
                                </td>

                                <td class="p-3">
                                    {{ $user->sector?->name ?? '-' }}
                                </td>

                                <td class="p-3">
                                    {{ $user->role === 'super_admin' ? 'Super Admin' : 'Usuário' }}
                                </td>
                                <td class="p-3">
                                    @if ($user->active)
                                    <span class="text-green-600 font-medium">
                                        Ativo
                                    </span>
                                    @else
                                    <span class="text-red-600 font-medium">
                                        Inativo
                                    </span>
                                    @endif
                                </td>
                                <td class="p-3">

                                    <div class="flex justify-end gap-3">

                                        <a
                                            href="{{ route('users.edit', $user) }}"
                                            class="text-blue-600 hover:underline">
                                            Editar
                                        </a>

                                        @if ($user->id !== auth()->id())

                                        <form
                                            method="POST"
                                            action="{{ route('users.destroy', $user) }}"
                                            onsubmit="return confirm('Deseja realmente excluir este usuário?')">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="text-red-600 hover:underline">
                                                Excluir
                                            </button>

                                        </form>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                            @empty

                            <tr>
                                <td colspan="5" class="p-6 text-center">
                                    Nenhum usuário cadastrado.
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