<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold uppercase tracking-widest text-indigo-600">Administração</p>
            <h1 class="mt-1 text-2xl font-bold text-slate-900">Painel administrativo</h1>
            <p class="mt-1 text-sm text-slate-500">Gerencie os recursos e acompanhe as operações da plataforma.</p>
        </div>
    </x-slot>

    <div class="py-10 sm:py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                <a href="{{ route('sectors.index') }}" class="group rounded-2xl border border-slate-200 bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:border-blue-200 hover:shadow-xl">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600"><svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m3-3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/></svg></div>
                    <h2 class="mt-5 text-xl font-bold text-slate-900">Setores</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-500">Organize e gerencie os setores da plataforma.</p>
                    <span class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-blue-600">Gerenciar <span class="transition group-hover:translate-x-1">→</span></span>
                </a>
                <a href="{{ route('users.index') }}" class="group rounded-2xl border border-slate-200 bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:border-emerald-200 hover:shadow-xl">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600"><svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zM18 18.72A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-6 5.969"/></svg></div>
                    <h2 class="mt-5 text-xl font-bold text-slate-900">Usuários</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-500">Cadastre usuários e controle seus acessos.</p>
                    <span class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-emerald-600">Gerenciar <span class="transition group-hover:translate-x-1">→</span></span>
                </a>
                <a href="{{ route('totem-inspections.index') }}" class="group rounded-2xl border border-slate-200 bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:border-indigo-200 hover:shadow-xl">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600"><svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M9 17.25v1.007A3 3 0 018.121 20.38L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25M5.25 4.5h13.5A2.25 2.25 0 0121 6.75V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V6.75A2.25 2.25 0 015.25 4.5z"/></svg></div>
                    <h2 class="mt-5 text-xl font-bold text-slate-900">Totens</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-500">Visualize e acompanhe todas as inspeções de totens.</p>
                    <span class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-indigo-600">Gerenciar <span class="transition group-hover:translate-x-1">→</span></span>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
