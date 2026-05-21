<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Modifier la candidature
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('job-applications.update', $jobApplication) }}">
                    @csrf
                    @method('PUT')

                    @include('job-applications._form', [
                        'submitLabel' => 'Enregistrer',
                    ])
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
