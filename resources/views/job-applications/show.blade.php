<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ $jobApplication->company_name }}
                </h2>
                <p class="mt-1 text-sm text-gray-500">{{ $jobApplication->position_title }}</p>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('job-applications.edit', $jobApplication) }}" class="inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">
                    Modifier
                </a>

                <form method="POST" action="{{ route('job-applications.destroy', $jobApplication) }}">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="inline-flex items-center justify-center rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-gray-700">
                        Archiver
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto grid max-w-7xl gap-6 px-4 sm:px-6 lg:grid-cols-3 lg:px-8">
            <div class="space-y-6 lg:col-span-2">
                @if (session('success'))
                    <div class="rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
                        {{ session('success') }}
                    </div>
                @endif

                <section class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <h3 class="text-base font-semibold text-gray-900">Details</h3>

                    <dl class="mt-6 grid gap-5 sm:grid-cols-2">
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">Statut</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $jobApplication->statusLabel() }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">Priorite</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $jobApplication->priorityLabel() }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">Date</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $jobApplication->applied_at->format('d/m/Y') }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">Offre</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                @if ($jobApplication->offer_url)
                                    <a href="{{ $jobApplication->offer_url }}" class="text-indigo-700 hover:text-indigo-900" target="_blank" rel="noreferrer">
                                        Voir l'offre
                                    </a>
                                @else
                                    -
                                @endif
                            </dd>
                        </div>
                    </dl>

                    <div class="mt-6">
                        <h4 class="text-xs font-semibold uppercase tracking-wide text-gray-500">Notes</h4>
                        <p class="mt-2 whitespace-pre-line text-sm leading-6 text-gray-700">{{ $jobApplication->notes ?: '-' }}</p>
                    </div>
                </section>

                <section class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <div class="flex items-center justify-between">
                        <h3 class="text-base font-semibold text-gray-900">Entretiens</h3>

                        <a href="{{ route('job-applications.interviews.create', $jobApplication) }}" class="inline-flex items-center justify-center rounded-md bg-gray-900 px-3 py-2 text-sm font-semibold text-white transition hover:bg-gray-700">
                            Ajouter
                        </a>
                    </div>

                    <div class="mt-5 divide-y divide-gray-100">
                        @forelse ($jobApplication->interviews as $interview)
                            <div class="py-4">
                                <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                                    <p class="text-sm font-semibold text-gray-900">{{ $interview->type }}</p>
                                    <p class="text-sm text-gray-500">{{ $interview->scheduled_at->format('d/m/Y H:i') }}</p>
                                </div>

                                @if ($interview->preparation_notes)
                                    <p class="mt-2 whitespace-pre-line text-sm text-gray-700">{{ $interview->preparation_notes }}</p>
                                @endif

                                @if ($interview->result)
                                    <p class="mt-2 whitespace-pre-line text-sm text-gray-700">{{ $interview->result }}</p>
                                @endif

                                <div class="mt-3 flex gap-3 text-sm font-medium">
                                    <a href="{{ route('job-applications.interviews.edit', [$jobApplication, $interview]) }}" class="text-indigo-700 hover:text-indigo-900">
                                        Modifier
                                    </a>

                                    <form method="POST" action="{{ route('job-applications.interviews.destroy', [$jobApplication, $interview]) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="text-gray-600 hover:text-gray-900">
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="py-6 text-sm text-gray-500">Aucun entretien enregistre.</p>
                        @endforelse
                    </div>
                </section>
            </div>

            <aside class="bg-white p-6 shadow-sm sm:rounded-lg lg:col-span-1">
                <h3 class="text-base font-semibold text-gray-900">Synthese</h3>

                <div class="mt-5 space-y-4">
                    <div class="rounded-md border border-gray-200 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Entreprise</p>
                        <p class="mt-1 text-sm font-medium text-gray-900">{{ $jobApplication->company_name }}</p>
                    </div>
                    <div class="rounded-md border border-gray-200 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Poste</p>
                        <p class="mt-1 text-sm font-medium text-gray-900">{{ $jobApplication->position_title }}</p>
                    </div>
                    <div class="rounded-md border border-gray-200 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Entretiens</p>
                        <p class="mt-1 text-sm font-medium text-gray-900">{{ $jobApplication->interviews->count() }}</p>
                    </div>
                </div>

                <div class="mt-6 border-t border-gray-100 pt-6">
                    <h3 class="text-base font-semibold text-gray-900">Documents</h3>

                    <form method="POST" action="{{ route('job-applications.documents.store', $jobApplication) }}" enctype="multipart/form-data" class="mt-4 space-y-3">
                        @csrf

                        <div>
                            <x-input-label for="document" value="Ajouter un fichier" />
                            <input
                                id="document"
                                name="document"
                                type="file"
                                class="mt-1 block w-full text-sm text-gray-700 file:mr-3 file:rounded-md file:border-0 file:bg-gray-900 file:px-3 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-gray-700"
                                required
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('document')" />
                        </div>

                        <x-primary-button>
                            Ajouter
                        </x-primary-button>
                    </form>

                    <div class="mt-5 divide-y divide-gray-100">
                        @forelse ($jobApplication->documents as $document)
                            <div class="py-4">
                                <p class="break-words text-sm font-semibold text-gray-900">{{ $document->original_name }}</p>
                                <p class="mt-1 text-xs text-gray-500">{{ number_format($document->size / 1024, 1, ',', ' ') }} Ko</p>

                                <div class="mt-3 flex gap-3 text-sm font-medium">
                                    <a href="{{ route('job-applications.documents.download', [$jobApplication, $document]) }}" class="text-indigo-700 hover:text-indigo-900">
                                        Telecharger
                                    </a>

                                    <form method="POST" action="{{ route('job-applications.documents.destroy', [$jobApplication, $document]) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="text-gray-600 hover:text-gray-900">
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="py-4 text-sm text-gray-500">Aucun document ajoute.</p>
                        @endforelse
                    </div>
                </div>
            </aside>
        </div>
    </div>
</x-app-layout>
