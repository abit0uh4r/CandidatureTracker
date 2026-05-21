<div class="grid gap-6">
    <div>
        <x-input-label for="type" value="Type d'entretien" />
        <x-text-input
            id="type"
            name="type"
            type="text"
            class="mt-1 block w-full"
            :value="old('type', $interview->type ?? '')"
            required
            autofocus
        />
        <x-input-error class="mt-2" :messages="$errors->get('type')" />
    </div>

    <div>
        <x-input-label for="scheduled_at" value="Date et heure planifiees" />
        <x-text-input
            id="scheduled_at"
            name="scheduled_at"
            type="datetime-local"
            class="mt-1 block w-full"
            :value="old('scheduled_at', optional($interview->scheduled_at ?? null)->format('Y-m-d\\TH:i'))"
            required
        />
        <x-input-error class="mt-2" :messages="$errors->get('scheduled_at')" />
    </div>

    <div>
        <x-input-label for="preparation_notes" value="Notes de preparation" />
        <textarea
            id="preparation_notes"
            name="preparation_notes"
            rows="5"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        >{{ old('preparation_notes', $interview->preparation_notes ?? '') }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('preparation_notes')" />
    </div>

    <div>
        <x-input-label for="result" value="Resultat" />
        <textarea
            id="result"
            name="result"
            rows="5"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        >{{ old('result', $interview->result ?? '') }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('result')" />
    </div>
</div>

<div class="mt-6 flex items-center justify-end gap-3">
    <a href="{{ route('job-applications.show', $jobApplication) }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">
        Annuler
    </a>

    <x-primary-button>
        {{ $submitLabel }}
    </x-primary-button>
</div>
