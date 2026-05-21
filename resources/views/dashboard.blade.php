<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tableau de bord
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">CandidatureTracker</h3>
                        <p class="mt-1 text-sm text-gray-600">Suivi actif des opportunites, statuts et priorites.</p>
                    </div>

                    <a href="{{ route('job-applications.index') }}" class="inline-flex items-center justify-center rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-gray-700">
                        Ouvrir les candidatures
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
