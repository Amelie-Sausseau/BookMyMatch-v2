<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Modifier mon entreprise') }}
        </h2>
    </header>

    <form method="post" action="{{ route('company.update', $company->id) }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <div class="row">
            <div class="col-md-6">
                <x-input-label for="image" :value="__('Ajouter une photo')" />
                <input type="file" name="image" class="form-control" />
                <x-input-error class="mt-2" :messages="$errors->get('image')" />
            </div>
            @if (isset($company->image))
                <p>Photo actuelle : </p>
                <img src="{{ asset('storage/uploads/' . $company->image) }}" alt="">
            @endif
        </div>

        <div>
            <x-input-label for="name" :value="__('Nom')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $company->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="address" :value="__('Adresse')" />
            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $company->address)"
                required autofocus autocomplete="address" />
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <div style="display: flex; gap: 20px">
            <div style="min-width: 30%">
                <x-input-label for="postal_code" :value="__('Code postal')" />
                <x-text-input id="postal_code" name="postal_code" type="tel" maxlength="5"
                    class="mt-1 block w-full" :value="old('postal_code', $company->postal_code)" required autofocus autocomplete="postal_code" />
                <x-input-error class="mt-2" :messages="$errors->get('postal_code')" />
            </div>

            <div style="min-width: 60%">
                <x-input-label for="city" :value="__('Ville')" />
                <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city', $company->city)"
                    required autofocus autocomplete="city" />
                <x-input-error class="mt-2" :messages="$errors->get('city')" />
            </div>
        </div>

        <div>
            <x-input-label for="available_seats" :value="__('Nombre de places maximum')" />
            <x-text-input id="available_seats" name="available_seats" type="number" class="mt-1 block w-full"
                :value="old('available_seats', $company->available_seats)" required autofocus autocomplete="available_seats" />
            <x-input-error class="mt-2" :messages="$errors->get('available_seats')" />
        </div>

        <div>
            <x-input-label for="opening_hours" :value="__('Horaires d\'ouverture')" />
            <x-text-input id="opening_hours" name="opening_hours" type="text" class="mt-1 block w-full"
                :value="old('opening_hours', $company->opening_hours)" required autofocus autocomplete="opening_hours" />
            <x-input-error class="mt-2" :messages="$errors->get('opening_hours')" />
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
