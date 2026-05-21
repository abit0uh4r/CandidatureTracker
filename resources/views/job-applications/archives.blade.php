<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Archives
                </h2>
                <p class="mt-1 text-sm text-gray-500">Candidatures retirees de la liste active.</p>
            </div>

            <a href="{{ route('job-applications.index') }}" class="inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">
                Retour aux candidatures
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Entreprise</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Poste</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Statut</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Priorite</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Archivee le</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wide text-gray-500">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse ($jobApplications as $jobApplication)
                                <tr class="hover:bg-gray-50">
                                    <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-gray-900">
                                        {{ $jobApplication->company_name }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $jobApplication->position_title }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">
                                        {{ $jobApplication->statusLabel() }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">
                                        {{ $jobApplication->priorityLabel() }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">
                                        {{ $jobApplication->deleted_at->format('d/m/Y') }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                        <form method="POST" action="{{ route('job-applications.restore', $jobApplication) }}">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit" class="text-indigo-700 hover:text-indigo-900">
                                                Restaurer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center text-sm text-gray-500">
                                        Aucune candidature archivee.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($jobApplications->hasPages())
                    <div class="border-t border-gray-100 px-6 py-4">
                        {{ $jobApplications->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
