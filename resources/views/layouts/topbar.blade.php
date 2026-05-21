@php
    $user = auth()->user();
    $initials = collect(explode(' ', $user->name ?? 'Utilisateur'))
        ->filter()
        ->take(2)
        ->map(fn ($part) => mb_substr($part, 0, 1))
        ->implode('');
@endphp

<header class="sticky top-0 z-20 border-b border-slate-200 bg-white">
    <div class="flex h-16 items-center justify-between px-6">
        <div>
            <p class="text-xs font-semibold uppercase text-slate-400">Espace personnel</p>
            <p class="mt-0.5 text-sm text-slate-600">Suivi clair de vos candidatures et entretiens</p>
        </div>

        <div class="flex items-center gap-3">
            <div class="relative">
                <input
                    type="text"
                    value=""
                    placeholder="Recherche rapide"
                    class="h-10 w-64 rounded-full border-slate-200 bg-slate-50 pl-10 pr-4 text-sm text-slate-500 shadow-sm focus:border-slate-300 focus:ring-slate-300"
                    aria-label="Recherche rapide"
                >
                <svg class="absolute left-3.5 top-2.5 h-5 w-5 text-slate-400" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="m20 20-4.5-4.5M18 11a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
            </div>

            <a href="{{ route('job-applications.create') }}" class="inline-flex h-10 items-center justify-center rounded-lg bg-[#0b2d5f] px-3.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#061f42]">
                Nouvelle candidature
            </a>

            <button
                type="button"
                class="relative grid h-10 w-10 place-items-center rounded-full border border-slate-200 bg-white text-[#0b2d5f] shadow-sm transition hover:bg-slate-50"
                aria-label="Notifications"
                title="Notifications"
            >
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M15.5 17.5h-7A2.5 2.5 0 0 1 6 15V11a6 6 0 0 1 12 0v4a2.5 2.5 0 0 1-2.5 2.5Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                    <path d="M10 20a2.2 2.2 0 0 0 4 0" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
                <span class="absolute right-2.5 top-2.5 h-2 w-2 rounded-full bg-rose-500 ring-2 ring-white"></span>
            </button>

            <div class="flex items-center gap-2.5 rounded-full border border-slate-200 bg-white py-1 pl-1.5 pr-3 shadow-sm">
                <div class="grid h-8 w-8 place-items-center rounded-full bg-slate-100 text-xs font-bold text-[#0b2d5f]">
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
