<section class="space-y-6">
    <header>
        <h2 class="text-lg font-bold text-rose-900">Supprimer le compte</h2>
        <p class="mt-1 text-sm leading-6 text-rose-700">
            Cette action supprime définitivement votre compte et les données associées. Elle doit rester exceptionnelle.
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >Supprimer le compte</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-bold text-slate-950">
                Confirmer la suppression
            </h2>

            <p class="mt-2 text-sm leading-6 text-slate-500">
                Entrez votre mot de passe pour confirmer la suppression définitive du compte.
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="Mot de passe" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-2 w-3/4"
                    placeholder="Mot de passe"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Annuler
                </x-secondary-button>

                <x-danger-button>
                    Supprimer
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
