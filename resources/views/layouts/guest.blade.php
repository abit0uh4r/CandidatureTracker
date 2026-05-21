<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CandidatureTracker') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-w-[1180px] bg-slate-100 font-sans text-slate-900 antialiased">
        <div class="grid min-h-screen grid-cols-[520px_1fr]">
            <main class="flex items-center justify-center px-16 py-10">
                <div class="w-full max-w-[410px]">
                    <a href="/" class="mb-10 flex items-center gap-3">
                        <x-application-logo class="h-12 w-12 text-[#0b2d5f]" />
                        <div>
                            <p class="text-lg font-bold text-slate-950">CandidatureTracker</p>
                            <p class="text-sm text-slate-500">Votre recherche d'emploi organisée</p>
                        </div>
                    </a>

                    <div class="ct-card p-8">
                        {{ $slot }}
                    </div>
                </div>
            </main>

            <aside class="relative overflow-hidden bg-[#071c3f] px-16 py-14 text-white">
                <div class="ct-auth-pattern absolute inset-0 opacity-20"></div>

                <div class="relative flex h-full flex-col justify-between">
                    <div>
                        <p class="text-sm font-semibold text-slate-300">Dashboard de suivi personnel</p>
                        <h1 class="mt-5 max-w-xl text-5xl font-bold leading-tight">
                            Gardez chaque opportunité visible, claire et actionnable.
                        </h1>
                        <p class="mt-6 max-w-lg text-base leading-7 text-slate-300">
                            Centralisez les candidatures, les entretiens, les priorités et les documents importants sans perdre le fil.
                        </p>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div class="rounded-2xl border border-white/10 bg-white/10 p-5">
                            <p class="text-3xl font-bold">01</p>
                            <p class="mt-2 text-sm text-slate-300">Suivre</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/10 p-5">
                            <p class="text-3xl font-bold">02</p>
                            <p class="mt-2 text-sm text-slate-300">Relancer</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/10 p-5">
                            <p class="text-3xl font-bold">03</p>
                            <p class="mt-2 text-sm text-slate-300">Archiver</p>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </body>
</html>
