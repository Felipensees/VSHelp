<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Usuário
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <form method="POST" action="{{ route('users.update', $user) }}">

                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block font-medium">
                                Nome
                            </label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name', $user->name) }}"
                                class="w-full border-gray-300 rounded"
                                required
                            >

                            @error('name')
                                <p class="text-red-600 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium">
                                E-mail
                            </label>

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email', $user->email) }}"
                                class="w-full border-gray-300 rounded"
                                required
                            >

                            @error('email')
                                <p class="text-red-600 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium">
                                Setor
                            </label>

                            <select
                                name="sector_id"
                                class="w-full border-gray-300 rounded"
                            >
                                <option value="">
                                    Nenhum setor
                                </option>

                                @foreach ($sectors as $sector)
                                    <option
                                        value="{{ $sector->id }}"
                                        @selected(old('sector_id', $user->sector_id) == $sector->id)
                                    >
                                        {{ $sector->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('sector_id')
                                <p class="text-red-600 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium">
                                Perfil
                            </label>

                            <select
                                name="role"
                                class="w-full border-gray-300 rounded"
                                required
                            >
                                <option
                                    value="user"
                                    @selected(old('role', $user->role) === 'user')
                                >
                                    Usuário
                                </option>

                                <option
                                    value="super_admin"
                                    @selected(old('role', $user->role) === 'super_admin')
                                >
                                    Super Admin
                                </option>
                            </select>

                            @error('role')
                                <p class="text-red-600 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium">
                                Nova senha
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="w-full border-gray-300 rounded"
                            >

                            <p class="text-sm text-gray-500 mt-1">
                                Deixe em branco para manter a senha atual.
                            </p>

                            @error('password')
                                <p class="text-red-600 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block font-medium">
                                Confirmar nova senha
                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                class="w-full border-gray-300 rounded"
                            >
                        </div>

                        <div class="flex gap-3">

                            <a
                                href="{{ route('users.index') }}"
                                class="px-4 py-2 bg-gray-200 rounded"
                            >
                                Cancelar
                            </a>

                            <button
                                type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded"
                            >
                                Atualizar
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</x-app-layout>