<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Alterar senha
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <p class="mb-6 text-gray-600">
                        Antes de continuar, defina uma nova senha para sua conta.
                    </p>

                    <form
                        method="POST"
                        action="{{ route('password.first.update') }}"
                    >

                        @csrf
                        @method('PUT')

                        <div class="mb-4">

                            <label class="block font-medium">
                                Nova senha
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="w-full border-gray-300 rounded"
                                required
                            >

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
                                required
                            >

                        </div>

                        <button
                            type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded"
                        >
                            Alterar senha
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>