<div class="grid grid-cols-2 gap-6">
    <div>
        <x-input-label for="company_name" value="Nom de l'entreprise" />
        <x-text-input
            id="company_name"
            name="company_name"
            type="text"
            class="mt-2"
            :value="old('company_name', $jobApplication->company_name ?? '')"
            required
            autofocus
        />
        <x-input-error class="mt-2" :messages="$errors->get('company_name')" />
    </div>

    <div>
        <x-input-label for="position_title" value="Poste visé" />
        <x-text-input
            id="position_title"
            name="position_title"
            type="text"
            class="mt-2"
            :value="old('position_title', $jobApplication->position_title ?? '')"
            required
        />
        <x-input-error class="mt-2" :messages="$errors->get('position_title')" />
    </div>

    <div>
        <x-input-label for="offer_url" value="URL de l'offre" />
        <x-text-input
            id="offer_url"
            name="offer_url"
            type="url"
            class="mt-2"
            :value="old('offer_url', $jobApplication->offer_url ?? '')"
            placeholder="https://..."
        />
        <x-input-error class="mt-2" :messages="$errors->get('offer_url')" />
    </div>

    <div>
        <x-input-label for="applied_at" value="Date de candidature" />
        <x-text-input
            id="applied_at"
            name="applied_at"
            type="date"
            class="mt-2"
            :value="old('applied_at', optional($jobApplication->applied_at ?? null)->format('Y-m-d'))"
            required
        />
        <x-input-error class="mt-2" :messages="$errors->get('applied_at')" />
    </div>

    <div>
        <x-input-label for="status" value="Statut" />
        <x-select-input id="status" name="status" class="mt-2" required>
            @foreach ($statuses as $value => $label)
                <option value="{{ $value }}" @selected(old('status', $jobApplication->status ?? 'draft') === $value)>
                    {{ $label }}
                </option>
            @endforeach
        </x-select-input>
        <x-input-error class="mt-2" :messages="$errors->get('status')" />
    </div>

    <div>
        <x-input-label for="priority" value="Priorité" />
        <x-select-input id="priority" name="priority" class="mt-2" required>
            @foreach ($priorities as $value => $label)
                <option value="{{ $value }}" @selected(old('priority', $jobApplication->priority ?? 'medium') === $value)>
                    {{ $label }}
                </option>
            @endforeach
        </x-select-input>
        <x-input-error class="mt-2" :messages="$errors->get('priority')" />
    </div>

    <div class="col-span-2">
        <x-input-label for="notes" value="Notes" />
        <x-textarea-input id="notes" name="notes" rows="7" class="mt-2" placeholder="Relances, contacts, éléments importants...">{{ old('notes', $jobApplication->notes ?? '') }}</x-textarea-input>
        <x-input-error class="mt-2" :messages="$errors->get('notes')" />
    </div>
</div>

<div class="mt-8 flex items-center justify-end gap-3 border-t border-slate-100 pt-6">
    <a href="{{ $cancelUrl ?? route('job-applications.index') }}" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
        Annuler
    </a>

    <x-primary-button>
        {{ $submitLabel }}
    </x-primary-button>
</div>
