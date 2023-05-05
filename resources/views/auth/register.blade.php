<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Prénom + nom -->
            <div class="mt-4">
                <x-input-label for="firstname" :value="__('Prénom *')" />
                <x-text-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname')"
                    required autofocus />
                <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="lastname" :value="__('Nom *')" />
                <x-text-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')"
                    required autofocus />
                <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
            </div>


            <!-- Email  -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email *')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Mot de passe -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Mot de passe *')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirmer le mdp -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirmez le mot de passe *')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Choix du role -->
            <div class="mt-4">
                <x-input-label for="role" :value="__('Vous êtes *')" />
                <div style="display: flex; gap: 10px;">
                    <div style="display: flex; align-items:center; gap: 5px;">
                        <label for="client">Un client</label>
                        <x-text-input id="client" type="radio" value="1" name="role" checked />
                    </div>
                    <div style="display: flex; align-items:center; gap: 5px;">
                        <label for="professionnel">Un professionnel</label>
                        <x-text-input id="pro" type="radio" value="2" name="role" />
                    </div>
                </div>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>

            <div class="form-group row text-center">
                <div class="mt-4" style="text-align: start;">
                    <label for="politique">J'ai lu et j'accepte les
                        <a href="{{ route('politique') }}" class="underline">mentions légales et la politique de
                            confidentialité *</a>
                    </label>
                    <input class="mx-auto" type="checkbox" name="politique" id="politique"
                        onclick="toggleValidationButtonDisplay()">
                </div>
                <x-input-error :messages="$errors->get('politique.required')" class="mt-2" />
            </div>

            <script>
                function toggleValidationButtonDisplay() {
                    let checkbox = document.getElementById("politique");
                    let boutonValider = document.getElementById("valider");
                    checkbox.checked ? boutonValider.style.visibility = "visible" : boutonValider.style.visibility = "hidden"
                }
            </script>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('Déjà inscrit ?') }}
                </a>

                <x-primary-button class="ml-4" style="visibility: hidden" id="valider">
                    {{ __('Inscription') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
