<x-app-layout>
    <x-page-header
        :title="$jobApplication->company_name"
        :subtitle="$jobApplication->position_title"
    >
        <x-slot name="actions">
            @if ($jobApplication->trashed())
                <form method="POST" action="{{ route('job-applications.restore', $jobApplication) }}">
                    @csrf
                    @method('PATCH')

                    <x-primary-button>
                        Restaurer
                    </x-primary-button>
                </form>
            @else
                <a href="{{ route('job-applications.edit', $jobApplication) }}" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                    Modifier
                </a>

                <form method="POST" action="{{ route('job-applications.destroy', $jobApplication) }}">
                    @csrf
                    @method('DELETE')

                    <x-primary-button>
                        Archiver
                    </x-primary-button>
                </form>
            @endif
        </x-slot>
    </x-page-header>

    @if (session('success'))
        <x-alert class="mb-6">{{ session('success') }}</x-alert>
    @endif

    <div class="grid grid-cols-[minmax(0,1fr)_380px] gap-6">
        <div class="space-y-6">
            <x-ui.card>
                <div class="flex items-start justify-between gap-6">
                    <div>
                        <p class="text-sm font-semibold text-slate-500">Dossier candidature</p>
                        <h2 class="mt-2 text-2xl font-bold text-slate-950">{{ $jobApplication->company_name }}</h2>
                        <p class="mt-1 text-base text-slate-600">{{ $jobApplication->position_title }}</p>
                    </div>

                    <div class="flex items-center gap-2">
                        <x-status-badge :status="$jobApplication->status" />
                        <x-priority-badge :priority="$jobApplication->priority" />
                    </div>
                </div>

                <dl class="mt-8 grid grid-cols-3 gap-5">
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <dt class="text-sm font-semibold text-slate-500">Date de candidature</dt>
                        <dd class="mt-2 text-lg font-bold text-slate-950">{{ $jobApplication->applied_at->format('d/m/Y') }}</dd>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <dt class="text-sm font-semibold text-slate-500">Entretiens</dt>
                        <dd class="mt-2 text-lg font-bold text-slate-950">{{ $jobApplication->interviews->count() }}</dd>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <dt class="text-sm font-semibold text-slate-500">Documents</dt>
                        <dd class="mt-2 text-lg font-bold text-slate-950">{{ $jobApplication->documents->count() }}</dd>
                    </div>
                </dl>
            </x-ui.card>

            <div class="grid grid-cols-2 gap-6">
                <x-ui.card>
                    <h3 class="text-lg font-bold text-slate-950">Informations principales</h3>
                    <dl class="mt-5 space-y-4">
                        <div class="flex items-center justify-between gap-4">
                            <dt class="text-sm font-semibold text-slate-500">Statut</dt>
                            <dd><x-status-badge :status="$jobApplication->status" /></dd>
                        </div>
                        <div class="flex items-center justify-between gap-4">
                            <dt class="text-sm font-semibold text-slate-500">Priorité</dt>
                            <dd><x-priority-badge :priority="$jobApplication->priority" /></dd>
                        </div>
                        <div class="flex items-center justify-between gap-4">
                            <dt class="text-sm font-semibold text-slate-500">Archive</dt>
                            <dd class="text-sm font-semibold text-slate-900">
                                {{ $jobApplication->trashed() ? 'Oui' : 'Non' }}
                            </dd>
                        </div>
                    </dl>
                </x-ui.card>

                <x-ui.card>
                    <h3 class="text-lg font-bold text-slate-950">URL de l'offre</h3>
                    @if ($jobApplication->offer_url)
                        <a href="{{ $jobApplication->offer_url }}" target="_blank" rel="noreferrer" class="mt-5 inline-flex max-w-full break-all text-sm font-semibold text-[#0b2d5f] hover:text-[#061f42]">
                            {{ $jobApplication->offer_url }}
                        </a>
                    @else
                        <p class="mt-5 text-sm text-slate-500">Aucune URL renseignée.</p>
                    @endif
                </x-ui.card>
            </div>

            <x-ui.card>
                <h3 class="text-lg font-bold text-slate-950">Notes</h3>
                <p class="mt-4 min-h-20 whitespace-pre-line rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm leading-6 text-slate-600">
                    {{ $jobApplication->notes ?: 'Aucune note pour cette candidature.' }}
                </p>
            </x-ui.card>

            <x-ui.card>
                <div class="flex items-center justify-between gap-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-950">Entretiens</h3>
                        <p class="mt-1 text-sm text-slate-500">Historique et préparation des étapes de recrutement.</p>
                    </div>

                    @if (! $jobApplication->trashed())
                        <a href="{{ route('job-applications.interviews.create', $jobApplication) }}" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                            Page dédiée
                        </a>
                    @endif
                </div>

                @if (! $jobApplication->trashed())
                    <form method="POST" action="{{ route('job-applications.interviews.store', $jobApplication) }}" class="mt-6 rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        @csrf

                        <div class="grid grid-cols-2 gap-5">
                            <div>
                                <x-input-label for="type" value="Type d'entretien" />
                                <x-text-input id="type" name="type" type="text" class="mt-2 bg-white" :value="old('type')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('type')" />
                            </div>

                            <div>
                                <x-input-label for="scheduled_at" value="Date et heure" />
                                <x-text-input id="scheduled_at" name="scheduled_at" type="datetime-local" class="mt-2 bg-white" :value="old('scheduled_at')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('scheduled_at')" />
                            </div>

                            <div>
                                <x-input-label for="preparation_notes" value="Notes de préparation" />
                                <x-textarea-input id="preparation_notes" name="preparation_notes" rows="4" class="mt-2 bg-white">{{ old('preparation_notes') }}</x-textarea-input>
                                <x-input-error class="mt-2" :messages="$errors->get('preparation_notes')" />
                            </div>

                            <div>
                                <x-input-label for="result" value="Résultat" />
                                <x-textarea-input id="result" name="result" rows="4" class="mt-2 bg-white">{{ old('result') }}</x-textarea-input>
                                <x-input-error class="mt-2" :messages="$errors->get('result')" />
                            </div>
                        </div>

                        <div class="mt-5 flex justify-end">
                            <x-primary-button>
                                Ajouter l'entretien
                            </x-primary-button>
                        </div>
                    </form>
                @endif

                <div class="mt-6 divide-y divide-slate-100">
                    @forelse ($jobApplication->interviews as $interview)
                        <article class="py-5">
                            <div class="flex items-start justify-between gap-5">
                                <div>
                                    <h4 class="font-bold text-slate-950">{{ $interview->type }}</h4>
                                    <p class="mt-1 text-sm text-slate-500">{{ $interview->scheduled_at->format('d/m/Y H:i') }}</p>
                                </div>

                                @if (! $jobApplication->trashed())
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('job-applications.interviews.edit', [$jobApplication, $interview]) }}" class="ct-action-link">Modifier</a>

                                        <form method="POST" action="{{ route('job-applications.interviews.destroy', [$jobApplication, $interview]) }}">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="text-sm font-semibold text-slate-500 transition hover:text-rose-600">
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>

                            <div class="mt-4 grid grid-cols-2 gap-4">
                                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                    <p class="text-sm font-semibold text-slate-500">Préparation</p>
                                    <p class="mt-2 whitespace-pre-line text-sm leading-6 text-slate-700">{{ $interview->preparation_notes ?: 'Aucune note.' }}</p>
                                </div>
                                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                    <p class="text-sm font-semibold text-slate-500">Résultat</p>
                                    <p class="mt-2 whitespace-pre-line text-sm leading-6 text-slate-700">{{ $interview->result ?: 'Résultat non renseigné.' }}</p>
                                </div>
                            </div>
                        </article>
                    @empty
                        <x-empty-state
                            title="Aucun entretien enregistré"
                            description="Ajoutez un entretien pour préparer les prochaines étapes de ce dossier."
                            class="mt-6"
                        />
                    @endforelse
                </div>
            </x-ui.card>
        </div>

        <aside class="space-y-6">
            <x-ui.card>
                <h3 class="text-lg font-bold text-slate-950">Résumé du suivi</h3>
                <div class="mt-5 space-y-4">
                    <div class="flex gap-3">
                        <div class="mt-1 h-3 w-3 rounded-full bg-[#0b2d5f]"></div>
                        <div>
                            <p class="text-sm font-semibold text-slate-950">Candidature ajoutée</p>
                            <p class="text-sm text-slate-500">{{ $jobApplication->applied_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <div class="mt-1 h-3 w-3 rounded-full bg-amber-400"></div>
                        <div>
                            <p class="text-sm font-semibold text-slate-950">Statut actuel</p>
                            <p class="text-sm text-slate-500">{{ $jobApplication->statusLabel() }}</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <div class="mt-1 h-3 w-3 rounded-full bg-emerald-500"></div>
                        <div>
                            <p class="text-sm font-semibold text-slate-950">Dernière mise à jour</p>
                            <p class="text-sm text-slate-500">{{ $jobApplication->updated_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>
            </x-ui.card>

            <x-ui.card>
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-slate-950">Documents</h3>
                        <p class="mt-1 text-sm text-slate-500">CV, lettre ou pièces liées à la candidature.</p>
                    </div>
                </div>

                @if (! $jobApplication->trashed())
                    <form method="POST" action="{{ route('job-applications.documents.store', $jobApplication) }}" enctype="multipart/form-data" class="mt-5 rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        @csrf

                        <x-input-label for="document" value="Ajouter un fichier" />
                        <input
                            id="document"
                            name="document"
                            type="file"
                            class="mt-2 block w-full text-sm text-slate-600 file:mr-3 file:rounded-xl file:border-0 file:bg-[#0b2d5f] file:px-3 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-[#061f42]"
                            required
                        />
                        <x-input-error class="mt-2" :messages="$errors->get('document')" />

                        <x-primary-button class="mt-4 w-full">
                            Ajouter
                        </x-primary-button>
                    </form>
                @endif

                <div class="mt-5 divide-y divide-slate-100">
                    @forelse ($jobApplication->documents as $document)
                        <div class="py-4">
                            <p class="break-words text-sm font-bold text-slate-950">{{ $document->original_name }}</p>
                            <p class="mt-1 text-xs text-slate-500">{{ number_format($document->size / 1024, 1, ',', ' ') }} Ko · {{ $document->created_at->format('d/m/Y') }}</p>

                            @if (! $jobApplication->trashed())
                                <div class="mt-3 flex gap-3">
                                    <a href="{{ route('job-applications.documents.download', [$jobApplication, $document]) }}" class="ct-action-link">
                                        Télécharger
                                    </a>

                                    <form method="POST" action="{{ route('job-applications.documents.destroy', [$jobApplication, $document]) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="text-sm font-semibold text-slate-500 transition hover:text-rose-600">
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @empty
                        <x-empty-state
                            title="Aucun document"
                            description="Les fichiers ajoutés à cette candidature seront listés ici."
                            class="mt-5 py-8"
                        />
                    @endforelse
                </div>
            </x-ui.card>
        </aside>
    </div>
</x-app-layout>
