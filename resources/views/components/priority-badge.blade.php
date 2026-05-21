@props(['priority'])

@php
    $classes = [
        'low' => 'bg-slate-100 text-slate-700 ring-slate-200',
        'medium' => 'bg-orange-50 text-orange-700 ring-orange-200',
        'high' => 'bg-rose-50 text-rose-700 ring-rose-200',
    ][$priority] ?? 'bg-slate-100 text-slate-700 ring-slate-200';

    $label = \App\Models\JobApplication::PRIORITIES[$priority] ?? $priority;
@endphp

<span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset {{ $classes }}">
    {{ $label }}
</span>
