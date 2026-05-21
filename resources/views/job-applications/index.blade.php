<x-app-layout>
    <x-page-header
        title="Mes candidatures"
        subtitle="Toutes vos candidatures actives, filtrables par statut, priorité ou recherche texte."
    >
        <x-slot name="actions">
            <a href="{{ route('job-applications.archives') }}" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                Archives
            </a>
            <a href="{{ route('job-applications.create') }}" class="inline-flex items-center justify-center rounded-xl bg-[#0b2d5f] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#061f42]">
                Nouvelle candidature
            </a>
        </x-slot>
    </x-page-header>

    @if (session('success'))
        <x-alert class="mb-6">{{ session('success') }}</x-alert>
    @endif

    <x-ui.card class="mb-6">
        <form method="GET" action="{{ route('job-applications.index') }}" class="grid grid-cols-[minmax(260px,1fr)_220px_220px_auto_auto] items-end gap-4">
            @csrf

            <div>
                <x-input-label for="search" value="Recherche" />
                <x-text-input
                    id="search"
                    name="search"
                    type="search"
                    class="mt-2"
                    :value="$filters['search'] ?? ''"
                    placeholder="Entreprise ou poste"
                />
                <x-input-error class="mt-2" :messages="$errors->get('search')" />
            </div>

            <div>
                <x-input-label for="status" value="Statut" />
                <x-select-input id="status" name="status" class="mt-2">
                    <option value="">Tous les statuts</option>
                    @foreach ($statuses as $value => $label)
                        <option value="{{ $value }}" @selected(($filters['status'] ?? '') === $value)>
                            {{ $label }}
                        </option>
                    @endforeach
                </x-select-input>
                <x-input-error class="mt-2" :messages="$errors->get('status')" />
            </div>

            <div>
                <x-input-label for="priority" value="Priorité" />
                <x-select-input id="priority" name="priority" class="mt-2">
                    <option value="">Toutes</option>
                    @foreach ($priorities as $value => $label)
                        <option value="{{ $value }}" @selected(($filters['priority'] ?? '') === $value)>
                            {{ $label }}
                        </option>
                    @endforeach
                </x-select-input>
                <x-input-error class="mt-2" :messages="$errors->get('priority')" />
            </div>

            <x-primary-button>
                Filtrer
            </x-primary-button>

            <a href="{{ route('job-applications.index') }}" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                Réinitialiser
            </a>
        </form>
    </x-ui.card>

    <x-ui.card class="p-0">
        <div class="overflow-hidden rounded-2xl">
            <table class="min-w-full divide-y divide-slate-100">
                <thead class="bg-slate-50">
                    <tr>
                        <th scope="col" class="ct-table-th">Entreprise</th>
                        <th scope="col" class="ct-table-th">Poste</th>
                        <th scope="col" class="ct-table-th">Statut</th>
                        <th scope="col" class="ct-table-th">Priorité</th>
                        <th scope="col" class="ct-table-th">Date de candidature</th>
                        <th scope="col" class="ct-table-th text-center">Entretiens</th>
                        <th scope="col" class="ct-table-th text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($jobApplications as $jobApplication)
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
                            <td class="ct-table-td whitespace-nowrap">{{ $jobApplication->applied_at->format('d/m/Y') }}</td>
                            <td class="ct-table-td text-center font-semibold text-slate-900">{{ $jobApplication->interviews_count ?? 0 }}</td>
                            <td class="ct-table-td">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('job-applications.show', $jobApplication) }}" class="ct-action-link">Voir</a>
                                    <a href="{{ route('job-applications.edit', $jobApplication) }}" class="ct-action-link">Modifier</a>

                                    <form method="POST" action="{{ route('job-applications.destroy', $jobApplication) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="text-sm font-semibold text-slate-500 transition hover:text-rose-600">
                                            Archiver
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10">
                                <x-empty-state
                                    title="Aucune candidature active"
                                    description="Ajoutez votre première candidature pour suivre son statut, sa priorité et ses entretiens."
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

        @if ($jobApplications->hasPages())
            <div class="border-t border-slate-100 px-6 py-4">
                {{ $jobApplications->links() }}
            </div>
        @endif
    </x-ui.card>
</x-app-layout>
