@props(['active' => false, 'href' => '#'])

<a
    href="{{ $href }}"
    {{ $attributes->merge([
        'class' => ($active
            ? 'bg-white text-[#071c3f] shadow-sm'
            : 'text-slate-300 hover:bg-white/10 hover:text-white') . ' flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition',
    ]) }}
>
    @isset($icon)
        <span class="{{ $active ? 'bg-[#0b2d5f] text-white' : 'bg-white/10 text-slate-200' }} grid h-8 w-8 place-items-center rounded-lg">
            {{ $icon }}
        </span>
    @endisset

    <span>{{ $slot }}</span>
</a>
