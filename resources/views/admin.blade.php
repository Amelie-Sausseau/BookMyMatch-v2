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

                        <div class="relative overflow-x-auto" id="companiesList">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <th scope="col" class="px-6 py-3">Nom</th>
                                    <th scope="col" class="px-6 py-3">Adresse</th>
                                    <th scope="col" class="px-6 py-3">Horaires d'ouverture</th>
                                    <th scope="col" class="px-6 py-3">Nombre de places</th>
                                    <th scope="col" class="px-6 py-3">Responsable</th>
                                </thead>
                                @foreach ($companies as $company)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4">{{ $company->name }}</td>
                                        <td class="px-6 py-4">
                                            {{ $company->address, $company->postal_code, $company->city }}</td>
                                        <td class="px-6 py-4">{{ $company->opening_hours }}</td>
                                        <td class="px-6 py-4">{{ $company->available_seats }}</td>
                                        <td class="px-6 py-4">{{ $company->user->firstname }}
                                            {{ $company->user->lastname }}</td>
                                        <td class="px-6 py-4">
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

                        <div class="relative overflow-x-auto" id="eventsList">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <th scope="col" class="px-6 py-3">Titre</th>
                                    <th scope="col" class="px-6 py-3">Date</th>
                                </thead>
                                @foreach ($events as $event)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4">{{ $event->title }}</td>
                                        <td class="px-6 py-4">{{ date('d/m/Y à H:i', strtotime($event->date)) }}</td>
                                        <td class="px-6 py-4">
                                            <form action="{{ route('booking.destroy', $event->id) }}" method="delete">
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

                        <div class="relative overflow-x-auto" id="bookingsList">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <th scope="col" class="px-6 py-3">Evènement</th>
                                    <th scope="col" class="px-6 py-3">Date</th>
                                    <th scope="col" class="px-6 py-3">Nombre de places</th>
                                    <th scope="col" class="px-6 py-3">Client</th>
                                    <th scope="col" class="px-6 py-3">Etablissement</th>
                                </thead>
                                @foreach ($bookings as $booking)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4">{{ $booking->event_id }}</td>
                                        <td class="px-6 py-4">{{ $booking->schedule_date }}</td>
                                        <td class="px-6 py-4">{{ $booking->scheduled_seats }}</td>
                                        <td class="px-6 py-4">{{ $booking->user->firstname }}
                                            {{ $booking->user->lastname }}</td>
                                        <td class="px-6 py-4">{{ $booking->company_id }}</td>
                                        <td class="px-6 py-4">
                                            <form action="{{ route('booking.destroy', $booking) }}" method="delete">
                                                @csrf
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

                        <div class="relative overflow-x-auto" id="usersList">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <th scope="col" class="px-6 py-3">Nom</th>
                                    <th scope="col" class="px-6 py-3">Prénom</th>
                                    <th scope="col" class="px-6 py-3">Email</th>
                                    <th scope="col" class="px-6 py-3">Rôle</th>
                                </thead>
                                @foreach ($users as $user)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4">{{ $user->lastname }}</td>
                                        <td class="px-6 py-4">{{ $user->firstname }}</td>
                                        <td class="px-6 py-4">{{ $user->email }}</td>
                                        <td class="px-6 py-4">{{ $user->role->role }}</td>
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
