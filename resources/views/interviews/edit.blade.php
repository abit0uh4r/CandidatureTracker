<x-app-layout>
    <x-page-header
        title="Modifier un entretien"
        :subtitle="$jobApplication->company_name . ' · ' . $jobApplication->position_title"
    >
        <x-slot name="actions">
            <a href="{{ route('job-applications.show', $jobApplication) }}" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                Retour au dossier
            </a>
        </x-slot>
    </x-page-header>

    <x-ui.card class="max-w-5xl">
        <form method="POST" action="{{ route('job-applications.interviews.update', [$jobApplication, $interview]) }}">
            @csrf
            @method('PUT')

            @include('interviews._form', [
                'submitLabel' => 'Enregistrer',
            ])
        </form>
    </x-ui.card>
</x-app-layout>
