<x-guest-layout>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-950">Confirmation requise</h1>
        <p class="mt-2 text-sm leading-6 text-slate-500">
            Confirmez votre mot de passe avant de continuer cette action sensible.
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="password" value="Mot de passe" />
            <x-text-input id="password" class="mt-2" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <x-primary-button class="w-full">
            Confirmer
        </x-primary-button>
    </form>
</x-guest-layout>
