<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CandidatureTracker') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-w-[1180px] bg-slate-100 font-sans antialiased text-slate-900">
        <div class="min-h-screen">
            @include('layouts.sidebar')

            <div class="ml-64 min-h-screen">
                @include('layouts.topbar')

                <main class="px-6 py-6">
                    @isset($header)
                        {{ $header }}
                    @endisset

                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
