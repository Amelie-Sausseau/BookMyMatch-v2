<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
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
                                <a href="{{ route('company-detail', $company->id) }}"><p><i class="fa-solid fa-eye"></i></p></a>
                                <a href="{{ route('profile.company-edit', $company->id) }}"><p><i class="fa-solid fa-pen-to-square"></i></p></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</x-app-layout>
