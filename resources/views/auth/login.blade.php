<x-layouts.auth>
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-header text-center"><strong>{{ __('ui.login_title') }}</strong></div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="InputEmail1">{{ __('ui.email_address') }}</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="InputEmail1" name="email" value="{{ old('email') }}" placeholder="{{ __('ui.email_address') }}" required>
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="InputPassword1">{{ __('ui.password') }}</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="InputPassword1" name="password" placeholder="{{ __('ui.password') }}" required>
                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">{{ __('ui.login') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.auth>