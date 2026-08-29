<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold uppercase tracking-widest text-indigo-600">Área do usuário</p>
            <h1 class="mt-1 text-2xl font-bold text-slate-900">Olá, {{ auth()->user()->name }}!</h1>
            <p class="mt-1 text-sm text-slate-500">Escolha uma área para começar.</p>
        </div>
    </x-slot>

    <div class="py-10 sm:py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-8 overflow-hidden rounded-3xl bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950 p-8 text-white shadow-xl sm:p-10">
                <span class="inline-flex rounded-full bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-indigo-200">VSHelp</span>
                <h2 class="mt-5 max-w-2xl text-3xl font-bold tracking-tight sm:text-4xl">Tudo o que você precisa, em um só lugar.</h2>
                <p class="mt-3 max-w-xl text-slate-300">Registre e acompanhe ocorrências ou realize as inspeções dos totens com rapidez.</p>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <a href="{{ route('occurrences.index') }}" class="group rounded-2xl border border-slate-200 bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:border-rose-200 hover:shadow-xl">
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-rose-50 text-rose-600 transition group-hover:bg-rose-600 group-hover:text-white">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 4.5h.008v.008H12V16.5z"/></svg>
                    </div>
                    <h3 class="mt-6 text-xl font-bold text-slate-900">Ocorrências</h3>
                    <p class="mt-2 text-sm leading-6 text-slate-500">Acesse a central para registrar e acompanhar ocorrências.</p>
                    <span class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-rose-600">Acessar ocorrências <span class="transition group-hover:translate-x-1">→</span></span>
                </a>

                <a href="{{ route('totem-inspections.index') }}" class="group rounded-2xl border border-slate-200 bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:border-indigo-200 hover:shadow-xl">
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 transition group-hover:bg-indigo-600 group-hover:text-white">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25M5.25 4.5h13.5A2.25 2.25 0 0121 6.75v8.25a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V6.75A2.25 2.25 0 015.25 4.5z"/></svg>
                    </div>
                    <h3 class="mt-6 text-xl font-bold text-slate-900">Totens</h3>
                    <p class="mt-2 text-sm leading-6 text-slate-500">Inicie uma inspeção ou consulte os totens já verificados.</p>
                    <span class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-indigo-600">Acessar totens <span class="transition group-hover:translate-x-1">→</span></span>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
