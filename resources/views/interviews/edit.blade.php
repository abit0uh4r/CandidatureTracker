<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Modifier un entretien
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                {{ $jobApplication->company_name }} - {{ $jobApplication->position_title }}
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('job-applications.interviews.update', [$jobApplication, $interview]) }}">
                    @csrf
                    @method('PUT')

                    @include('interviews._form', [
                        'submitLabel' => 'Enregistrer',
                    ])
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
