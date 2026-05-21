<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Page introuvable - {{ config('app.name', 'CandidatureTracker') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-w-[1180px] bg-slate-100 text-slate-900">
        <main class="grid min-h-screen place-items-center px-8">
            <section class="ct-card max-w-xl p-10 text-center">
                <div class="mx-auto grid h-16 w-16 place-items-center rounded-2xl bg-slate-50 text-[#0b2d5f] ring-1 ring-slate-200">
                    <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M6 5h12a1 1 0 0 1 1 1v13l-3-2-3 2-3-2-3 2V6a1 1 0 0 1 1-1Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                        <path d="M9 9h6M9 13h4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                    </svg>
                </div>

                <p class="mt-6 text-sm font-semibold text-[#0b2d5f]">Erreur 404</p>
                <h1 class="mt-2 text-3xl font-bold text-slate-950">Page introuvable</h1>
                <p class="mt-3 text-sm leading-6 text-slate-500">
                    La page demandée n'existe pas ou a été déplacée.
                </p>

                <a href="{{ auth()->check() ? route('dashboard') : route('login') }}" class="mt-7 inline-flex items-center justify-center rounded-xl bg-[#0b2d5f] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#061f42]">
                    Retour au tableau de bord
                </a>
            </section>
        </main>
    </body>
</html>
