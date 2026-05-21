<x-guest-layout>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-950">Connexion</h1>
        <p class="mt-2 text-sm leading-6 text-slate-500">
            Accédez à votre espace de suivi et reprenez vos candidatures là où vous les avez laissées.
        </p>
    </div>

    <x-auth-session-status class="mb-5" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" value="Adresse email" />
            <x-text-input id="email" class="mt-2" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <div class="flex items-center justify-between">
                <x-input-label for="password" value="Mot de passe" />

                @if (Route::has('password.request'))
                    <a class="text-sm font-semibold text-[#0b2d5f] hover:text-[#061f42]" href="{{ route('password.request') }}">
                        Mot de passe oublié ?
                    </a>
                @endif
            </div>

            <x-text-input id="password" class="mt-2" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <label for="remember_me" class="inline-flex items-center gap-2 text-sm font-medium text-slate-600">
            <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-[#0b2d5f] shadow-sm focus:ring-[#0b2d5f]" name="remember">
            Se souvenir de moi
        </label>

        <x-primary-button class="w-full">
            Se connecter
        </x-primary-button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-500">
        Pas encore de compte ?
        <a href="{{ route('register') }}" class="font-semibold text-[#0b2d5f] hover:text-[#061f42]">Créer un compte</a>
    </p>
</x-guest-layout>
