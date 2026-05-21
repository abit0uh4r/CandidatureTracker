<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Accès refusé - {{ config('app.name', 'CandidatureTracker') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-w-[1180px] bg-slate-100 text-slate-900">
        <main class="grid min-h-screen place-items-center px-8">
            <section class="ct-card max-w-xl p-10 text-center">
                <div class="mx-auto grid h-16 w-16 place-items-center rounded-2xl bg-rose-50 text-rose-600 ring-1 ring-rose-100">
                    <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 3.5 20 7v5.5c0 4.5-3.1 7.5-8 8-4.9-.5-8-3.5-8-8V7l8-3.5Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                        <path d="M12 9v4M12 16h.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>

                <p class="mt-6 text-sm font-semibold text-rose-600">Erreur 403</p>
                <h1 class="mt-2 text-3xl font-bold text-slate-950">Accès refusé</h1>
                <p class="mt-3 text-sm leading-6 text-slate-500">
                    Vous n'êtes pas autorisé à consulter cette ressource.
                </p>

                <a href="{{ auth()->check() ? route('dashboard') : route('login') }}" class="mt-7 inline-flex items-center justify-center rounded-xl bg-[#0b2d5f] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#061f42]">
                    Retour au tableau de bord
                </a>
            </section>
        </main>
    </body>
</html>
