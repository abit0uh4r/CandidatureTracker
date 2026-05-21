<div class="grid gap-6 md:grid-cols-2">
    <div>
        <x-input-label for="company_name" value="Entreprise" />
        <x-text-input
            id="company_name"
            name="company_name"
            type="text"
            class="mt-1 block w-full"
            :value="old('company_name', $jobApplication->company_name ?? '')"
            required
            autofocus
        />
        <x-input-error class="mt-2" :messages="$errors->get('company_name')" />
    </div>

    <div>
        <x-input-label for="position_title" value="Poste vise" />
        <x-text-input
            id="position_title"
            name="position_title"
            type="text"
            class="mt-1 block w-full"
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
            class="mt-1 block w-full"
            :value="old('offer_url', $jobApplication->offer_url ?? '')"
        />
        <x-input-error class="mt-2" :messages="$errors->get('offer_url')" />
    </div>

    <div>
        <x-input-label for="applied_at" value="Date de candidature" />
        <x-text-input
            id="applied_at"
            name="applied_at"
            type="date"
            class="mt-1 block w-full"
            :value="old('applied_at', optional($jobApplication->applied_at ?? null)->format('Y-m-d'))"
            required
        />
        <x-input-error class="mt-2" :messages="$errors->get('applied_at')" />
    </div>

    <div>
        <x-input-label for="status" value="Statut" />
        <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
            @foreach ($statuses as $value => $label)
                <option value="{{ $value }}" @selected(old('status', $jobApplication->status ?? 'draft') === $value)>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('status')" />
    </div>

    <div>
        <x-input-label for="priority" value="Priorite" />
        <select id="priority" name="priority" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
            @foreach ($priorities as $value => $label)
                <option value="{{ $value }}" @selected(old('priority', $jobApplication->priority ?? 'medium') === $value)>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('priority')" />
    </div>

    <div class="md:col-span-2">
        <x-input-label for="notes" value="Notes" />
        <textarea
            id="notes"
            name="notes"
            rows="6"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        >{{ old('notes', $jobApplication->notes ?? '') }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('notes')" />
    </div>
</div>

<div class="mt-6 flex items-center justify-end gap-3">
    <a href="{{ route('job-applications.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">
        Annuler
    </a>

    <x-primary-button>
        {{ $submitLabel }}
    </x-primary-button>
</div>
