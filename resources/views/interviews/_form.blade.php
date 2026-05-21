<div class="grid grid-cols-2 gap-6">
    <div>
        <x-input-label for="type" value="Type d'entretien" />
        <x-text-input
            id="type"
            name="type"
            type="text"
            class="mt-2"
            :value="old('type', $interview->type ?? '')"
            required
            autofocus
        />
        <x-input-error class="mt-2" :messages="$errors->get('type')" />
    </div>

    <div>
        <x-input-label for="scheduled_at" value="Date et heure planifiée" />
        <x-text-input
            id="scheduled_at"
            name="scheduled_at"
            type="datetime-local"
            class="mt-2"
            :value="old('scheduled_at', optional($interview->scheduled_at ?? null)->format('Y-m-d\\TH:i'))"
            required
        />
        <x-input-error class="mt-2" :messages="$errors->get('scheduled_at')" />
    </div>

    <div>
        <x-input-label for="preparation_notes" value="Notes de préparation" />
        <x-textarea-input id="preparation_notes" name="preparation_notes" rows="6" class="mt-2">{{ old('preparation_notes', $interview->preparation_notes ?? '') }}</x-textarea-input>
        <x-input-error class="mt-2" :messages="$errors->get('preparation_notes')" />
    </div>

    <div>
        <x-input-label for="result" value="Résultat" />
        <x-textarea-input id="result" name="result" rows="6" class="mt-2">{{ old('result', $interview->result ?? '') }}</x-textarea-input>
        <x-input-error class="mt-2" :messages="$errors->get('result')" />
    </div>
</div>

<div class="mt-8 flex items-center justify-end gap-3 border-t border-slate-100 pt-6">
    <a href="{{ route('job-applications.show', $jobApplication) }}" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
        Annuler
    </a>

    <x-primary-button>
        {{ $submitLabel }}
    </x-primary-button>
</div>
