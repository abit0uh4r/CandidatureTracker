@props(['type' => 'success'])

@php
    $classes = $type === 'error'
        ? 'border-rose-200 bg-rose-50 text-rose-700'
        : 'border-emerald-200 bg-emerald-50 text-emerald-700';
@endphp

<div {{ $attributes->merge(['class' => 'rounded-2xl border px-4 py-3 text-sm font-semibold ' . $classes]) }}>
    {{ $slot }}
</div>
