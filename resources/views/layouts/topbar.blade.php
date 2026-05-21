@php
    $user = auth()->user();
    $initials = collect(explode(' ', $user->name ?? 'Utilisateur'))
        ->filter()
        ->take(2)
        ->map(fn ($part) => mb_substr($part, 0, 1))
        ->implode('');
@endphp

<header class="sticky top-0 z-20 border-b border-slate-200 bg-white">
    <div class="flex h-20 items-center justify-between px-8">
        <div>
            <p class="text-xs font-semibold uppercase text-slate-400">Espace personnel</p>
            <p class="mt-1 text-sm text-slate-600">Suivi clair de vos candidatures et entretiens</p>
        </div>

        <div class="flex items-center gap-4">
            <div class="relative">
                <input
                    type="text"
                    value=""
                    placeholder="Recherche rapide"
                    class="h-11 w-72 rounded-full border-slate-200 bg-slate-50 pl-10 pr-4 text-sm text-slate-500 shadow-sm focus:border-slate-300 focus:ring-slate-300"
                    aria-label="Recherche rapide"
                >
                <svg class="absolute left-3.5 top-3 h-5 w-5 text-slate-400" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="m20 20-4.5-4.5M18 11a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
            </div>

            <a href="{{ route('job-applications.create') }}" class="inline-flex h-11 items-center justify-center rounded-xl bg-[#0b2d5f] px-4 text-sm font-semibold text-white shadow-sm transition hover:bg-[#061f42]">
                Nouvelle candidature
            </a>

            <div class="flex items-center gap-3 rounded-full border border-slate-200 bg-white py-1.5 pl-2 pr-4 shadow-sm">
                <div class="grid h-9 w-9 place-items-center rounded-full bg-slate-100 text-sm font-bold text-[#0b2d5f]">
                    {{ $initials }}
                </div>
                <div>
                    <p class="text-sm font-semibold text-slate-900">{{ $user->name }}</p>
                    <p class="text-xs text-slate-500">{{ now()->format('d/m/Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</header>
