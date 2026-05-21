<x-app-layout>
    <x-page-header
        title="Nouvelle candidature"
        subtitle="Ajoutez une opportunité avec son statut, sa priorité et les informations utiles pour le suivi."
    >
        <x-slot name="actions">
            <a href="{{ route('job-applications.index') }}" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                Retour à la liste
            </a>
        </x-slot>
    </x-page-header>

    <x-ui.card class="max-w-5xl">
        <form method="POST" action="{{ route('job-applications.store') }}">
            @csrf

            @include('job-applications._form', [
                'submitLabel' => 'Enregistrer',
                'cancelUrl' => route('job-applications.index'),
            ])
        </form>
    </x-ui.card>
</x-app-layout>
