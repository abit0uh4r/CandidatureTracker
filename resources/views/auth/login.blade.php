<x-guest-layout>
    <div class="mb-8 text-center">
        <h1 class="text-4xl font-bold text-[#071c3f]">Connexion</h1>
        <p class="mt-4 text-lg leading-7 text-slate-500">
            Accédez à votre espace de suivi de candidatures
        </p>
    </div>

    <x-auth-session-status class="mb-5" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <x-input-label for="email" value="Adresse e-mail" />
            <x-text-input id="email" class="mt-2 h-14" type="email" name="email" :value="old('email')" placeholder="vous@exemple.com" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" value="Mot de passe" />
            <x-text-input id="password" class="mt-2 h-14" type="password" name="password" placeholder="••••••••••" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <label for="remember_me" class="inline-flex items-center gap-3 text-sm font-medium text-slate-600">
            <input id="remember_me" type="checkbox" class="h-5 w-5 rounded border-slate-300 text-[#0b2d5f] shadow-sm focus:ring-[#0b2d5f]" name="remember">
            Se souvenir de moi
        </label>

        <x-primary-button class="h-14 w-full text-base">
            Se connecter
        </x-primary-button>
    </form>

    @if (Route::has('password.request'))
        <div class="mt-7 text-center">
            <a class="text-base font-semibold text-blue-700 hover:text-blue-800" href="{{ route('password.request') }}">
                Mot de passe oublié ?
            </a>
        </div>
    @endif

    <div class="mt-8 border-t border-slate-200 pt-7 text-center text-base text-slate-500">
        Pas encore de compte ?
        <a href="{{ route('register') }}" class="ml-3 font-semibold text-blue-700 hover:text-blue-800">Créer un compte</a>
    </div>
</x-guest-layout>
