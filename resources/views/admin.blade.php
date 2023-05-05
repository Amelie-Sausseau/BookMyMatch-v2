<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Espace administrateur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <script>
                let nomsTableaux = ['companiesList', 'eventsList', 'bookingsList', 'usersList']

                function showElement(elementId) {
                    nomsTableaux.forEach(element => {
                        document.getElementById(element).style.display = 'none'
                    });
                    let element = document.getElementById(elementId);
                    element.style.display == "block" ? element.style.display = "none" : element.style.display = "block";
                }
            </script>

            <h1>Gérer</h1>
            <div class="row">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900"
                        style="display: flex; flex-direction: column; align-items: start; gap: 30px">
                        <button onclick="showElement('companiesList')">Les établissements</button>

                        <div class="container p-5" style="display:none" id="companiesList">
                            <table class="table table-info">
                                <thead class="thead-dark">
                                    <th>Nom</th>
                                    <th>Adresse</th>
                                    <th>Horaires d'ouverture</th>
                                    <th>Nombre de places</th>
                                    <th>Responsable</th>
                                </thead>
                                @foreach ($companies as $company)
                                    <tr>
                                        <td>{{ $company->name }}</td>
                                        <td>{{ $company->address, $company->postal_code, $company->city }}</td>
                                        <td>{{ $company->opening_hours }}</td>
                                        <td>{{ $company->available_seats }}</td>
                                        <td>{{ $company->user_id }}</td>
                                        <td>
                                            <form action="{{ route('booking.destroy', $company->id) }}" method="delete">
                                                <button>
                                                    <p><i class="fa-solid fa-trash"></i></p>
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{ route('booking.edit', $company->id) }}" method="get">
                                                <button>
                                                    <p><i class="fa-solid fa-pen-to-square"></i></p>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900"
                        style="display: flex; flex-direction: column; align-items: start; gap: 30px">
                        <button onclick="showElement('eventsList')">Les évènements</button>

                        <div class="container p-5" style="display:none" id="eventsList">
                            <table class="table table-info">
                                <thead class="thead-dark">
                                    <th>Match</th>
                                    <th>Date</th>
                                </thead>
                                @foreach ($events as $event)
                                    <tr>
                                        <td>{{ $event->title }}</td>
                                        <td>{{ $event->date }}</td>
                                        <td>
                                            <form action="{{ route('booking.destroy', $event->id) }}"
                                                method="delete">
                                                <button>
                                                    <p><i class="fa-solid fa-trash"></i></p>
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{ route('booking.edit', $event->id) }}" method="get">
                                                <button>
                                                    <p><i class="fa-solid fa-pen-to-square"></i></p>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900"
                        style="display: flex; flex-direction: column; align-items: start; gap: 30px">
                        <button onclick="showElement('bookingsList')">Les réservations</button>

                        <div class="container p-5" style="display:none" id="bookingsList">
                            <table class="table table-info">
                                <thead class="thead-dark">
                                    <th>Evènement</th>
                                    <th>Date réservée</th>
                                    <th>Nombre de places</th>
                                    <th>Etablissement</th>
                                    <th>Client</th>
                                </thead>
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td>{{ $booking->event_id }}</td>
                                        <td>{{ $booking->schedule_date }}</td>
                                        <td>{{ $booking->scheduled_seats }}</td>
                                        <td>{{ $booking->company_id }}</td>
                                        <td>{{ $booking->user_id }}</td>
                                        <td>
                                            <form action="{{ route('booking.destroy', $booking->id) }}"
                                                method="delete">
                                                <button>
                                                    <p><i class="fa-solid fa-trash"></i></p>
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{ route('booking.edit', $booking->id) }}" method="get">
                                                <button>
                                                    <p><i class="fa-solid fa-pen-to-square"></i></p>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900"
                        style="display: flex; flex-direction: column; align-items: start; gap: 30px">
                        <button onclick="showElement('usersList')">Les utilisateurs</button>

                        <div class="container p-5" style="display:none" id="usersList">
                            <table class="table table-info">
                                <thead class="thead-dark">
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Email</th>
                                    <th>Type d'utilisateur</th>
                                </thead>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->lastname }}</td>
                                        <td>{{ $user->firstname }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role_id }}</td>
                                        <td>
                                            <form action="{{ route('booking.edit', $user->id) }}" method="get">
                                                <button>
                                                    <p><i class="fa-solid fa-pen-to-square"></i></p>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
