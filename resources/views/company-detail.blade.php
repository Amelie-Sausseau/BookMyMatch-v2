<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($company->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div style="display: flex;flex-direction: column;align-items: center;
            ">
                    <img src="{{ asset('storage/uploads/' . $company->image) }}" alt="">
                    <div class="presentation-generale" style="text-align: center">
                        <h3>{{ $company->address }}</h3>
                        <h3>{{ $company->postal_code . ' ' . $company->city }}</h3>
                        <h3>Horaires : {{ $company->opening_hours }}</h3>
                    </div>
                    <div class="infos-resa" style="margin: 1.5rem">
                        @if ($company->events[0])
                        @foreach ($company->events as $event)
                        @if ($loop->first) {{session()->put('event', $event)}}
                        <p>Date du prochain match :
                            {{ date('d/m/Y à H:i', strtotime($event->date)) }}</p>
                        <p>Nombre de places restantes : {{ $event->seats}} </p>
                        @endif
                        @endforeach
                        @endif
                    </div>
                    @if (Auth::user()->role_id == 1) @php
                        session()->put('company', $company);

                    @endphp
                    <div style="display: flex; justify-content: center;">
                        <a href="{{ route('booking.create') }}" class="bmm-btn">Réserver</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
