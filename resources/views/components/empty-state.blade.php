@props(['title', 'description' => null])

<div {{ $attributes->merge(['class' => 'rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-8 py-10 text-center']) }}>
    <div class="mx-auto grid h-12 w-12 place-items-center rounded-2xl bg-white text-[#0b2d5f] shadow-sm ring-1 ring-slate-200">
        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M7 7.5h10M7 12h10M7 16.5h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
            <path d="M5.8 3.5h12.4A1.8 1.8 0 0 1 20 5.3v13.4a1.8 1.8 0 0 1-1.8 1.8H5.8A1.8 1.8 0 0 1 4 18.7V5.3a1.8 1.8 0 0 1 1.8-1.8Z" stroke="currentColor" stroke-width="1.8"/>
        </svg>
    </div>

    <h3 class="mt-4 text-base font-bold text-slate-950">{{ $title }}</h3>

    @if ($description)
        <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">{{ $description }}</p>
    @endif

    @isset($action)
        <div class="mt-6 flex justify-center">
            {{ $action }}
        </div>
    @endisset
</div>
