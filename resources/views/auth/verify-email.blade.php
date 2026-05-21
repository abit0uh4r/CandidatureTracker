<x-guest-layout>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-950">Vérification email</h1>
        <p class="mt-2 text-sm leading-6 text-slate-500">
            Merci pour votre inscription. Vérifiez votre adresse email avec le lien reçu avant de continuer.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <x-alert class="mb-5">
            Un nouveau lien de vérification a été envoyé à votre adresse email.
        </x-alert>
    @endif

    <div class="flex items-center gap-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <x-primary-button>
                Renvoyer l'email
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-secondary-button type="submit">
                Déconnexion
            </x-secondary-button>
        </form>
    </div>
</x-guest-layout>
