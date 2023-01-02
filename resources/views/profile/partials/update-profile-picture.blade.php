<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Modifier votre photo de profil') }}
        </h2>

    </header>

    <form action="{{ route('profile.fileupload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('post')

        <div class="container">
            <div class="panel panel-primary">
               <div class="panel-body">
                  @if ($message = Session::get('success'))
                      <div class="alert alert-success alert-block">
                         <button type="button" class="close" data-dismiss="alert">×</button>
                         <strong>{{ $message }}</strong>
                      </div>
                  @endif

                    <div class="row">
                       <div class="col-md-6">
                          <input type="file" name="file" class="form-control"/>
                       </div>
                    </div>

                @if (isset(Auth::user()->image))
                    <div>
                        <h3>Photo de profil actuelle :</h3>
                        <img src="{{ asset('storage/uploads/' . Auth::user()->image) }}" alt="">
                    </div>
                @endif

                  @if (count($errors) > 0)
                  <div class="alert alert-danger">
                     <strong>Whoops!</strong> There were some problems with your input.
                     <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                     </ul>
                  </div>
                  @endif
               </div>
            </div>
         </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Enregistrer') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Modifications enregistrées') }}</p>
            @endif
        </div>
    </form>
</section>
