<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Trouver un établissement') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h1>Prochain match : {{$nextEvent->title}} le {{ date('d/m/Y à H:i', strtotime($nextEvent->date)) }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    <h2 style="font-weight: bold;">Etablissements disponibles</h2>
    </div>
    @foreach ($companiesList as $company)
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">

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
                                <a href="{{ route('company-detail', $company->id) }}">
                                    <p><i class="fa-solid fa-eye"></i></p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>
