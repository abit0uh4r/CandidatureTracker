<x-app-layout>
    <x-page-header
        title="Archives"
        subtitle="Les candidatures terminées restent consultables et peuvent être restaurées à tout moment."
    >
        <x-slot name="actions">
            <a href="{{ route('job-applications.index') }}" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                Retour aux candidatures
            </a>
        </x-slot>
    </x-page-header>

    @if (session('success'))
        <x-alert class="mb-6">{{ session('success') }}</x-alert>
    @endif

    <x-ui.card class="p-0">
        <div class="overflow-hidden rounded-2xl">
            <table class="min-w-full divide-y divide-slate-100">
                <thead class="bg-slate-50">
                    <tr>
                        <th scope="col" class="ct-table-th">Entreprise</th>
                        <th scope="col" class="ct-table-th">Poste</th>
                        <th scope="col" class="ct-table-th">Dernier statut</th>
                        <th scope="col" class="ct-table-th">Priorité</th>
                        <th scope="col" class="ct-table-th">Date d'archivage</th>
                        <th scope="col" class="ct-table-th text-center">Entretiens</th>
                        <th scope="col" class="ct-table-th text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($jobApplications as $jobApplication)
                        <tr class="hover:bg-slate-50">
                            <td class="ct-table-td font-semibold text-slate-950">{{ $jobApplication->company_name }}</td>
                            <td class="ct-table-td">{{ $jobApplication->position_title }}</td>
                            <td class="ct-table-td">
                                <x-status-badge :status="$jobApplication->status" />
                            </td>
                            <td class="ct-table-td">
                                <x-priority-badge :priority="$jobApplication->priority" />
                            </td>
                            <td class="ct-table-td whitespace-nowrap">{{ $jobApplication->deleted_at->format('d/m/Y') }}</td>
                            <td class="ct-table-td text-center font-semibold text-slate-900">{{ $jobApplication->interviews_count ?? 0 }}</td>
                            <td class="ct-table-td">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('job-applications.show', $jobApplication) }}" class="ct-action-link">Voir</a>

                                    <form method="POST" action="{{ route('job-applications.restore', $jobApplication) }}">
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit" class="text-sm font-semibold text-emerald-700 transition hover:text-emerald-800">
                                            Restaurer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10">
                                <x-empty-state
                                    title="Aucune candidature archivée"
                                    description="Lorsque vous archivez une candidature, elle quitte la liste principale mais reste disponible ici."
                                />
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
