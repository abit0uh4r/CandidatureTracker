<x-app-layout>
    <x-page-header
        title="Tableau de bord"
        subtitle="Vue d'ensemble de votre recherche d'emploi : candidatures actives, entretiens à venir et dossiers archivés."
    >
        <x-slot name="actions">
            <a href="{{ route('job-applications.create') }}" class="inline-flex items-center justify-center rounded-xl bg-[#0b2d5f] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#061f42]">
                Nouvelle candidature
            </a>
        </x-slot>
    </x-page-header>

    @if (session('success'))
        <x-alert class="mb-6">{{ session('success') }}</x-alert>
    @endif

    <div class="grid grid-cols-4 gap-5">
        <x-ui.card>
            <p class="text-sm font-semibold text-slate-500">Candidatures actives</p>
            <p class="mt-4 text-4xl font-bold text-slate-950">{{ $activeApplicationsCount ?? 0 }}</p>
            <p class="mt-3 text-sm text-slate-500">Dossiers visibles dans la liste principale.</p>
        </x-ui.card>

        <x-ui.card>
            <p class="text-sm font-semibold text-slate-500">Entretiens prévus</p>
            <p class="mt-4 text-4xl font-bold text-slate-950">{{ $upcomingInterviewsCount ?? 0 }}</p>
            <p class="mt-3 text-sm text-slate-500">Rendez-vous planifiés à partir d'aujourd'hui.</p>
        </x-ui.card>

        <x-ui.card>
            <p class="text-sm font-semibold text-slate-500">En attente</p>
            <p class="mt-4 text-4xl font-bold text-slate-950">{{ $waitingApplicationsCount ?? 0 }}</p>
            <p class="mt-3 text-sm text-slate-500">Candidatures qui nécessitent un suivi.</p>
        </x-ui.card>

        <x-ui.card>
            <p class="text-sm font-semibold text-slate-500">Archivées</p>
            <p class="mt-4 text-4xl font-bold text-slate-950">{{ $archivedApplicationsCount ?? 0 }}</p>
            <p class="mt-3 text-sm text-slate-500">Historique conservé sans encombrer la vue active.</p>
        </x-ui.card>
    </div>

    <div class="mt-6 grid grid-cols-[minmax(0,1fr)_380px] gap-6">
        <x-ui.card class="p-0">
            <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">
                <div>
                    <h2 class="text-lg font-bold text-slate-950">Candidatures récentes</h2>
                    <p class="mt-1 text-sm text-slate-500">Les derniers dossiers ajoutés ou mis à jour.</p>
                </div>

                <a href="{{ route('job-applications.index') }}" class="ct-action-link">Voir tout</a>
            </div>

            <div class="overflow-hidden">
                <table class="min-w-full divide-y divide-slate-100">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="ct-table-th">Entreprise</th>
                            <th class="ct-table-th">Poste</th>
                            <th class="ct-table-th">Statut</th>
                            <th class="ct-table-th">Priorité</th>
                            <th class="ct-table-th text-right">Entretiens</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse ($recentJobApplications ?? collect() as $jobApplication)
                            <tr class="hover:bg-slate-50">
                                <td class="ct-table-td font-semibold text-slate-950">
                                    <a href="{{ route('job-applications.show', $jobApplication) }}" class="hover:text-[#0b2d5f]">
                                        {{ $jobApplication->company_name }}
                                    </a>
                                </td>
                                <td class="ct-table-td">{{ $jobApplication->position_title }}</td>
                                <td class="ct-table-td">
                                    <x-status-badge :status="$jobApplication->status" />
                                </td>
                                <td class="ct-table-td">
                                    <x-priority-badge :priority="$jobApplication->priority" />
                                </td>
                                <td class="ct-table-td text-right font-semibold text-slate-900">
                                    {{ $jobApplication->interviews_count ?? 0 }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8">
                                    <x-empty-state
                                        title="Aucune candidature récente"
                                        description="Créez votre première candidature pour commencer à suivre vos opportunités."
                                    >
                                        <x-slot name="action">
                                            <a href="{{ route('job-applications.create') }}" class="inline-flex items-center justify-center rounded-xl bg-[#0b2d5f] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#061f42]">
                                                Nouvelle candidature
                                            </a>
                                        </x-slot>
                                    </x-empty-state>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-ui.card>

        <x-ui.card>
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-bold text-slate-950">Prochains entretiens</h2>
                    <p class="mt-1 text-sm text-slate-500">Les rendez-vous à préparer.</p>
                </div>
            </div>

            <div class="mt-5 space-y-4">
                @forelse ($upcomingInterviews ?? collect() as $interview)
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <p class="font-semibold text-slate-950">{{ $interview->type }}</p>
                                <p class="mt-1 text-sm text-slate-500">
                                    {{ $interview->jobApplication->company_name }} · {{ $interview->jobApplication->position_title }}
                                </p>
                            </div>
                            <p class="rounded-full bg-white px-3 py-1 text-xs font-semibold text-[#0b2d5f] ring-1 ring-slate-200">
                                {{ $interview->scheduled_at->format('d/m H:i') }}
                            </p>
                        </div>

                        <a href="{{ route('job-applications.show', $interview->jobApplication) }}" class="mt-4 inline-flex text-sm font-semibold text-[#0b2d5f] hover:text-[#061f42]">
                            Ouvrir le dossier
                        </a>
                    </div>
                @empty
                    <x-empty-state
                        title="Aucun entretien prévu"
                        description="Les entretiens ajoutés sur vos candidatures apparaîtront ici automatiquement."
                        class="py-8"
                    />
                @endforelse
            </div>
        </x-ui.card>
    </div>
</x-app-layout>
