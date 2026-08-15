<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header text-center"><strong>{{ __('ui.login_title') }}</strong></div>
                <div class="card-body">
                    <form wire:submit.prevent="login" action="#" method="POST">
                        <div class="form-group">
                            <label for="InputEmail1">{{ __('ui.email_address') }}</label>
                            <input wire:model="email" type="email" class="form-control" id="InputEmail1" placeholder="{{ __('ui.email_address') }}">
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="InputPassword1">{{ __('ui.password') }}</label>
                            <input wire:model.lazy="password" type="password" class="form-control" id="InputPassword1" placeholder="{{ __('ui.password') }}">
                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">{{ __('ui.login') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>