@props(['title', 'subtitle' => null])

<div {{ $attributes->merge(['class' => 'mb-5 flex items-start justify-between gap-5']) }}>
    <div>
        <h1 class="text-2xl font-bold text-slate-950">{{ $title }}</h1>

        @if ($subtitle)
            <p class="mt-1.5 max-w-3xl text-sm leading-5 text-slate-500">{{ $subtitle }}</p>
        @endif
    </div>

    @isset($actions)
        <div class="flex items-center gap-3">
            {{ $actions }}
        </div>
    @endisset
</div>
