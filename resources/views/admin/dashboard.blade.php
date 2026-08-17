<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Painel Administrativo
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-6">
                        Bem-vindo ao painel administrativo!
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a
                            href="{{ route('sectors.index') }}"
                            class="block rounded-lg border border-blue-200 bg-blue-50 p-6 text-left hover:bg-blue-100 transition"
                        >
                            <div class="text-xl font-semibold text-blue-700">Setores</div>
                            <p class="mt-2 text-sm text-blue-800">Gerencie os setores da plataforma.</p>
                        </a>

                        <a
                            href="{{ route('users.index') }}"
                            class="block rounded-lg border border-green-200 bg-green-50 p-6 text-left hover:bg-green-100 transition"
                        >
                            <div class="text-xl font-semibold text-green-700">Usuários</div>
                            <p class="mt-2 text-sm text-green-800">Visualize e acompanhe os usuários cadastrados.</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>