<x-app-layout>
    <x-page-header
        title="Documents"
        subtitle="Retrouvez les fichiers attachés à vos candidatures actives : CV, lettres de motivation et autres pièces utiles."
    >
        <x-slot name="actions">
            <a href="{{ route('job-applications.index') }}" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                Voir les candidatures
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
                        <th scope="col" class="ct-table-th">Nom du fichier</th>
                        <th scope="col" class="ct-table-th">Entreprise liée</th>
                        <th scope="col" class="ct-table-th">Poste lié</th>
                        <th scope="col" class="ct-table-th">Type</th>
                        <th scope="col" class="ct-table-th">Date d'ajout</th>
                        <th scope="col" class="ct-table-th text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($documents as $document)
                        <tr class="hover:bg-slate-50">
                            <td class="ct-table-td font-semibold text-slate-950">{{ $document->original_name }}</td>
                            <td class="ct-table-td">{{ $document->jobApplication->company_name }}</td>
                            <td class="ct-table-td">{{ $document->jobApplication->position_title }}</td>
                            <td class="ct-table-td">{{ $document->mime_type }}</td>
                            <td class="ct-table-td whitespace-nowrap">{{ $document->created_at->format('d/m/Y') }}</td>
                            <td class="ct-table-td">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('job-applications.documents.download', [$document->jobApplication, $document]) }}" class="ct-action-link">
                                        Télécharger
                                    </a>

                                    <form method="POST" action="{{ route('job-applications.documents.destroy', [$document->jobApplication, $document]) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="text-sm font-semibold text-slate-500 transition hover:text-rose-600">
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10">
                                <x-empty-state
                                    title="Aucun document"
                                    description="Ajoutez un fichier depuis le détail d'une candidature pour le voir apparaître ici."
                                />
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($documents->hasPages())
            <div class="border-t border-slate-100 px-6 py-4">
                {{ $documents->links() }}
            </div>
        @endif
    </x-ui.card>
</x-app-layout>
