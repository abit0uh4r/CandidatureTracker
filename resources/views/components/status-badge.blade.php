@props(['status'])

@php
    $classes = [
        'draft' => 'bg-slate-100 text-slate-700 ring-slate-200',
        'applied' => 'bg-blue-50 text-blue-700 ring-blue-200',
        'waiting' => 'bg-amber-50 text-amber-700 ring-amber-200',
        'interview' => 'bg-indigo-50 text-indigo-700 ring-indigo-200',
        'offer' => 'bg-emerald-50 text-emerald-700 ring-emerald-200',
        'rejected' => 'bg-rose-50 text-rose-700 ring-rose-200',
        'accepted' => 'bg-green-50 text-green-700 ring-green-200',
    ][$status] ?? 'bg-slate-100 text-slate-700 ring-slate-200';

    $label = \App\Models\JobApplication::STATUSES[$status] ?? $status;
@endphp

<span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset {{ $classes }}">
    {{ $label }}
</span>
