<x-guest-layout>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-950">Mot de passe oublié</h1>
        <p class="mt-2 text-sm leading-6 text-slate-500">
            Saisissez votre adresse email. Breeze enverra un lien pour choisir un nouveau mot de passe.
        </p>
    </div>

    <x-auth-session-status class="mb-5" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" value="Adresse email" />
            <x-text-input id="email" class="mt-2" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <x-primary-button class="w-full">
            Envoyer le lien de réinitialisation
        </x-primary-button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-500">
        <a href="{{ route('login') }}" class="font-semibold text-[#0b2d5f] hover:text-[#061f42]">Retour à la connexion</a>
    </p>
</x-guest-layout>
