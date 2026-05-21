<x-app-layout>
    <x-page-header
        title="Modifier la candidature"
        subtitle="Mettez à jour les informations de suivi pour ce dossier."
    >
        <x-slot name="actions">
            <a href="{{ route('job-applications.show', $jobApplication) }}" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                Retour au détail
            </a>
        </x-slot>
    </x-page-header>

    <x-ui.card class="max-w-5xl">
        <form method="POST" action="{{ route('job-applications.update', $jobApplication) }}">
            @csrf
            @method('PUT')

            @include('job-applications._form', [
                'submitLabel' => 'Mettre à jour',
                'cancelUrl' => route('job-applications.show', $jobApplication),
            ])
        </form>
    </x-ui.card>
</x-app-layout>
