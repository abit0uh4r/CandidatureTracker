@php
    $iconClass = 'h-5 w-5';
@endphp

<aside class="fixed inset-y-0 left-0 z-30 flex w-72 flex-col bg-[#071c3f] px-4 py-5 text-white">
    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-2">
        <x-application-logo class="h-11 w-11 text-white" />
        <div>
            <p class="text-base font-bold">CandidatureTracker</p>
            <p class="text-xs text-slate-300">Suivi d'emploi</p>
        </div>
    </a>

    <nav class="mt-8 space-y-2">
        <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            <x-slot name="icon">
                <svg class="{{ $iconClass }}" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M4 11.5 12 5l8 6.5V20a1 1 0 0 1-1 1h-5v-6h-4v6H5a1 1 0 0 1-1-1v-8.5Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                </svg>
            </x-slot>
            Tableau de bord
        </x-sidebar-link>

        <x-sidebar-link
            :href="route('job-applications.index')"
            :active="request()->routeIs('job-applications.index', 'job-applications.create', 'job-applications.show', 'job-applications.edit', 'job-applications.interviews.*')"
        >
            <x-slot name="icon">
                <svg class="{{ $iconClass }}" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M8 7V5.8A1.8 1.8 0 0 1 9.8 4h4.4A1.8 1.8 0 0 1 16 5.8V7" stroke="currentColor" stroke-width="1.8"/>
                    <path d="M5 7h14a1.5 1.5 0 0 1 1.5 1.5v9A2.5 2.5 0 0 1 18 20H6a2.5 2.5 0 0 1-2.5-2.5v-9A1.5 1.5 0 0 1 5 7Z" stroke="currentColor" stroke-width="1.8"/>
                    <path d="M9 12h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
            </x-slot>
            Candidatures
        </x-sidebar-link>

        <x-sidebar-link :href="route('job-applications.archives')" :active="request()->routeIs('job-applications.archives')">
            <x-slot name="icon">
                <svg class="{{ $iconClass }}" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M5 8h14v11a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V8Z" stroke="currentColor" stroke-width="1.8"/>
                    <path d="M4 4h16v4H4V4ZM9 12h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </x-slot>
            Archives
        </x-sidebar-link>

        @if (Route::has('documents.index'))
            <x-sidebar-link :href="route('documents.index')" :active="request()->routeIs('documents.index')">
                <x-slot name="icon">
                    <svg class="{{ $iconClass }}" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M7 3.8h6.5L18 8.3V20a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4.8a1 1 0 0 1 1-1Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                        <path d="M13.5 4v4.5H18M9 13h6M9 16h5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </x-slot>
                Documents
            </x-sidebar-link>
        @endif

        <x-sidebar-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
            <x-slot name="icon">
                <svg class="{{ $iconClass }}" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="1.8"/>
                    <path d="M4.5 20a7.5 7.5 0 0 1 15 0" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
            </x-slot>
            Profil
        </x-sidebar-link>
    </nav>

    <div class="mt-auto rounded-2xl border border-white/10 bg-white/5 p-4">
        <p class="text-sm font-semibold">{{ auth()->user()->name }}</p>
        <p class="mt-1 truncate text-xs text-slate-300">{{ auth()->user()->email }}</p>

        <form method="POST" action="{{ route('logout') }}" class="mt-4">
            @csrf

            <button type="submit" class="w-full rounded-xl bg-white/10 px-3 py-2 text-sm font-semibold text-white transition hover:bg-white/15">
                Déconnexion
            </button>
        </form>
    </div>
</aside>
