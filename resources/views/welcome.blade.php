<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'CandidatureTracker') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-w-[1180px] bg-slate-100 text-slate-900">
        <main class="grid min-h-screen place-items-center px-8">
            <section class="ct-card grid w-full max-w-5xl grid-cols-[1fr_420px] overflow-hidden p-0">
                <div class="bg-[#071c3f] p-12 text-white">
                    <x-application-logo class="h-12 w-12 text-white" />
                    <h1 class="mt-8 max-w-xl text-4xl font-bold leading-tight">
                        CandidatureTracker
                    </h1>
                    <p class="mt-4 max-w-xl text-base leading-7 text-slate-300">
                        Une interface claire pour suivre vos candidatures, vos entretiens, vos priorités et vos archives.
                    </p>
                </div>

                <div class="p-12">
                    <p class="text-sm font-semibold text-slate-500">Accès rapide</p>
                    <h2 class="mt-3 text-2xl font-bold text-slate-950">Ouvrir votre espace</h2>
                    <p class="mt-3 text-sm leading-6 text-slate-500">
                        Connectez-vous ou créez un compte pour commencer à organiser votre recherche d'emploi.
                    </p>

                    <div class="mt-8 flex gap-3">
                        @auth
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center rounded-xl bg-[#0b2d5f] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#061f42]">
                                Tableau de bord
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-xl bg-[#0b2d5f] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#061f42]">
                                Connexion
                            </a>
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                                Inscription
                            </a>
                        @endauth
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>
