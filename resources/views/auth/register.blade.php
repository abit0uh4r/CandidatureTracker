<x-guest-layout>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-950">Créer un compte</h1>
        <p class="mt-2 text-sm leading-6 text-slate-500">
            Démarrez un espace propre pour suivre vos candidatures, entretiens et documents.
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="name" value="Nom complet" />
            <x-text-input id="name" class="mt-2" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" value="Adresse email" />
            <x-text-input id="email" class="mt-2" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" value="Mot de passe" />
            <x-text-input id="password" class="mt-2" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" value="Confirmer le mot de passe" />
            <x-text-input id="password_confirmation" class="mt-2" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <x-primary-button class="w-full">
            Créer mon compte
        </x-primary-button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-500">
        Déjà inscrit ?
        <a href="{{ route('login') }}" class="font-semibold text-[#0b2d5f] hover:text-[#061f42]">Se connecter</a>
    </p>
</x-guest-layout>
