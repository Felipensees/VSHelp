<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold uppercase tracking-widest text-rose-600">Central de atendimento</p>
            <h1 class="mt-1 text-2xl font-bold text-slate-900">Ocorrências</h1>
            <p class="mt-1 text-sm text-slate-500">Consulte e acompanhe as ocorrências da plataforma.</p>
        </div>
    </x-slot>

    <div class="py-10 sm:py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center shadow-sm">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-rose-50 text-rose-600"><svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 4.5h.008v.008H12V16.5z"/></svg></div>
                <h2 class="mt-5 text-lg font-bold text-slate-900">Módulo de ocorrências</h2>
                <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">A área está pronta para receber o fluxo de cadastro e acompanhamento de ocorrências.</p>
                <a href="{{ route('dashboard') }}" class="mt-6 inline-flex items-center rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Voltar para a dashboard</a>
            </div>
        </div>
    </div>
</x-app-layout>
