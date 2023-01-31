<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ouvrir une réservation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>

                        @foreach ($companyEvent as $event)
                        <form method="post" action="{{ route('update-event', $event->company_id) }}" class="mt-6 space-y-6">
                            <input type="hidden"
                                            value="{{ $event->event_id }}" name="event_id">
                            @csrf
                            @method('post')
                            <div>
                                <x-input-label for="event" :value="__('Choisir un match')" />
                                <select id="event" name="event" class="mt-1 block w-full" required autofocus
                                autocomplete="event">
                                       <option>
                                        {{App\Models\Event::getEvent($event->event_id)->title}} le {{ date('d/m/Y à H:i', strtotime(App\Models\Event::getEvent($event->event_id)->date))}}
                                    </option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('company_events')" />
                            </div>

                            <div>
                                <x-input-label for="schedule_date" :value="__('Date de l\'évènement')" />
                                <x-text-input id="schedule_date" name="schedule_date" type="datetime-local" class="mt-1 block w-full" required autofocus
                                    autocomplete="schedule_date" value="{{$event->date}}"/>
                                <x-input-error class="mt-2" :messages="$errors->get('schedule_date')" />
                            </div>

                            <div>
                                <x-input-label for="seats" :value="__('Nombre de places disponibles')" />
                                <x-text-input id="seats" name="seats" type="number" class="mt-1 block w-full" required autofocus
                                    autocomplete="seats"  value="{{$event->seats}}"/>
                                <x-input-error class="mt-2" :messages="$errors->get('seats')" />
                            </div>


                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Enregistrer') }}</x-primary-button>

                                @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600">{{ __('Modifications enregistrées') }}</p>
                                    @endif
                                </div>
                            </form>
                            @endforeach
                    </section>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
