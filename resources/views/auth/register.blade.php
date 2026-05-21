<x-guest-layout>
    <div class="mb-8 text-center">
        <h1 class="text-4xl font-bold text-[#071c3f]">Créer un compte</h1>
        <p class="mt-4 text-lg leading-7 text-slate-500">
            Organisez votre recherche d'emploi simplement
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="name" value="Nom complet" />
            <x-text-input id="name" class="mt-2 h-14" type="text" name="name" :value="old('name')" placeholder="Votre nom complet" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" value="Adresse e-mail" />
            <x-text-input id="email" class="mt-2 h-14" type="email" name="email" :value="old('email')" placeholder="vous@exemple.com" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" value="Mot de passe" />
            <x-text-input id="password" class="mt-2 h-14" type="password" name="password" placeholder="••••••••••" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" value="Confirmer le mot de passe" />
            <x-text-input id="password_confirmation" class="mt-2 h-14" type="password" name="password_confirmation" placeholder="••••••••••" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <x-primary-button class="h-14 w-full text-base">
            S'inscrire
        </x-primary-button>
    </form>

    <div class="mt-8 flex items-center gap-5 text-center text-base text-slate-500">
        <div class="h-px flex-1 bg-slate-200"></div>
        <p>
            Déjà un compte ?
            <a href="{{ route('login') }}" class="ml-2 font-semibold text-blue-700 hover:text-blue-800">Se connecter</a>
        </p>
        <div class="h-px flex-1 bg-slate-200"></div>
    </div>
</x-guest-layout>
