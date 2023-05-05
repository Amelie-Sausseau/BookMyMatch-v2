<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (Auth::user()->role_id == 3)
                {{ __('Espace administrateur') }}
            @else
                {{ __('Dashboard') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" style="display: flex; flex-direction: column; gap: 20px">
                    {{ __('Bienvenue') }} {{ Auth::user()->firstname }}
                    <div style="display: flex; gap: 20px">
                        <a href="{{ route('profile.edit') }}"
                            class="text-sm text-gray-700 dark:text-gray-500 underline">Modifier mon profil</a>
                        @if (Auth::user()->role_id == 2)
                            <a href="{{ route('company') }}"
                                class="text-sm text-gray-700 dark:text-gray-500 underline">Ajouter un
                                établissement</a>
                        @endif
                    </div>
                </div>
            </div>
            @if (Auth::user()->role_id == 2)
                @if (count($companies) > 1)
                    <h1>Mes établissements</h1>
                @else
                    <h1>Mon établissement</h1>
                @endif
                @foreach ($companies as $company)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900" style="display: flex; gap: 30px">
                            <img src="{{ asset('storage/uploads/' . $company->image) }}"
                                style="width:100px; height: 100px; border-radius: 100%;" alt="">
                            <div style="flex-direction: column">
                                <h3 style="font-weight: bold">{{ $company->name }}</h3>
                                <p>{{ $company->address }}, {{ $company->postal_code }} {{ $company->city }}</p>
                                <p>{{ $company->available_seats }} places</p>
                                <p>Horaires : {{ $company->opening_hours }}</p>
                            </div>
                            <div class="company-choices" style="margin-inline-start: auto;">
                                <a href="{{ route('profile.add-booking', $company->id) }}">
                                    <p><i class="fa-solid fa-plus" alt="Ajouter un match"></i></p>
                                </a>
                                <a href="{{ route('company-detail', $company->id) }}">
                                    <p><i class="fa-solid fa-eye"></i></p>
                                </a>
                                <a href="{{ route('profile.company-edit', $company->id) }}">
                                    <p><i class="fa-solid fa-pen-to-square"></i></p>
                                </a>
                            </div>
                        </div>
                        @if (App\Models\Company::getCompanyEvent($company->id))
                            <div class="infos-resa" style="margin: 1.5rem">
                                <h3>Prochains évènements</h3>
                                @foreach (App\Models\Company::getCompanyEvent($company->id) as $event)
                                    - {{ App\Models\Event::getEvent($event->event_id)->title }} :
                                    {{ date('d/m/Y à H:i', strtotime($event->date)) }}
                                    <form method="get" action="{{ route('edit-booking') }}">@csrf
                                        @method('get')<button type="submit"
                                            class="fa-solid fa-pen-to-square"></button><input type="hidden"
                                            value="{{ $event->company_id }}" name="company_id_edit"><input
                                            type="hidden" value="{{ $event->event_id }}" name="event_id_edit">
                                    </form>
                                    <form method="post" action="{{ route('delete-event') }}">@csrf
                                        @method('delete')<button type="submit"
                                            class="fa-solid fa-trash"></button><input type="hidden"
                                            value="{{ $event->company_id }}" name="company_id"><input type="hidden"
                                            value="{{ $event->event_id }}" name="event_id">
                                    </form>
                                    </p><br></p>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            @endif
            @if (Auth::user()->role_id == 1)
                @if (count($bookings) > 1)
                    <h1>Mes réservations</h1>
                @else
                    <h1>Ma réservation</h1>
                @endif
                @foreach ($bookings as $booking)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900" style="display: flex; gap: 30px">
                            <img src="{{ asset('storage/uploads/' . App\Models\Company::getCompany($booking->company_id)->image) }}"
                                style="width:100px; height: 100px; border-radius: 100%;" alt="">
                            <div style="flex-direction: column">
                                <h3 style="font-weight: bold">
                                    {{ App\Models\Company::getCompany($booking->company_id)->name }}</h3>
                                <h4 style="font-weight: bold">Match
                                    {{ App\Models\Event::getEvent($booking->event_id)->title }} </h4>
                                <p>Le {{ date('d/m/Y à H:i', strtotime($booking->schedule_date)) }}</p>
                                <p>Nombre de places réservées : {{ $booking->scheduled_seats }}</p>
                            </div>
                            @if (App\Models\Event::getEvent($booking->event_id)->date > now())
                                <div class="company-choices" style="margin-inline-start: auto;">
                                    <form action="{{ route('booking.destroy', $booking->id) }}" method="delete">
                                        <button>
                                            <p><i class="fa-solid fa-trash"></i></p>
                                        </button>
                                    </form>
                                    <form action="{{ route('booking.edit', $booking->id) }}" method="get">
                                        <button>
                                            <p><i class="fa-solid fa-pen-to-square"></i></p>
                                        </button>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</x-app-layout>
