<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CandidatureTracker') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-w-[1180px] bg-slate-50 font-sans text-slate-900 antialiased">
        <div class="relative grid min-h-screen place-items-center overflow-hidden px-8 py-10">
            <div class="absolute -left-24 bottom-28 h-64 w-96 rotate-45 rounded-[4rem] bg-[#edf3ff] opacity-80"></div>
            <div class="absolute -right-24 top-28 h-72 w-96 rotate-45 rounded-[4rem] bg-[#eaf0ff] opacity-80"></div>
            <div class="absolute left-16 bottom-20 grid grid-cols-5 gap-3 opacity-40">
                @for ($i = 0; $i < 25; $i++)
                    <span class="h-1.5 w-1.5 rounded-full bg-[#9db4e8]"></span>
                @endfor
            </div>
            <div class="absolute right-20 top-20 grid grid-cols-5 gap-3 opacity-40">
                @for ($i = 0; $i < 25; $i++)
                    <span class="h-1.5 w-1.5 rounded-full bg-[#9db4e8]"></span>
                @endfor
            </div>

            <main class="relative w-full max-w-[620px]">
                <div class="rounded-3xl border border-slate-200 bg-white/95 px-14 py-12 shadow-2xl shadow-slate-300/40">
                    <a href="/" class="mx-auto mb-10 flex w-max items-center gap-4">
                        <x-application-logo class="h-12 w-12" />
                        <span class="text-2xl font-bold text-[#071c3f]">CandidatureTracker</span>
                    </a>

                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>
