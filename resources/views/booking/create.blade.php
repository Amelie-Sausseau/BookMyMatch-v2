<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Réserver des places') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>

                        <form method="post" action="{{ route('booking.store') }}" class="mt-6 space-y-6">
                            @csrf

                            <div>
                                <p>Match à réserver </p>
                                <p>
                                    {{ session()->get('event')->title }} le
                                    {{ date('d/m/Y à H:i', strtotime(session()->get('event')->date)) }}
                                </p>
                            </div>

                            <div>
                                <x-input-label for="schedule_date" :value="__('Sélectionner votre horaire d\'arrivée')" />
                                <x-text-input id="schedule_date" name="schedule_date" type="datetime-local"
                                    class="mt-1 block w-full" required autofocus autocomplete="schedule_date"
                                    value="{{ session()->get('event')->date }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('schedule_date')" />
                            </div>

                            <div>
                                <x-input-label for="scheduled_seats" :value="__('Nombre de places à réserver')" />
                                <x-text-input id="scheduled_seats" name="scheduled_seats" type="number"
                                    class="mt-1 block w-full" required autofocus autocomplete="scheduled_seats"
                                    max="{{ session()->get('event')->seats }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('scheduled_seats')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Enregistrer') }}</x-primary-button>

                                @if (session('status') === 'profile-updated')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600">{{ __('Modifications enregistrées') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
