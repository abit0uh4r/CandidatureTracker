<x-app-layout>
    <x-page-header
        title="Profil"
        subtitle="Gérez vos informations personnelles, votre mot de passe et les actions sensibles du compte."
    />

    <div class="grid grid-cols-2 gap-6">
        <x-ui.card>
            @include('profile.partials.update-profile-information-form')
        </x-ui.card>

        <x-ui.card>
            @include('profile.partials.update-password-form')
        </x-ui.card>

        <x-ui.card class="col-span-2 border-rose-100 bg-rose-50/40">
            @include('profile.partials.delete-user-form')
        </x-ui.card>
    </div>
</x-app-layout>
