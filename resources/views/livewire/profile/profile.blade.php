<div class="row" >
    <div class="col-lg-5 mx-auto mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white text-center">
                <h4 class="m-0"><i class="fa-solid fa-user-gear mr-2"></i> {{ __('ui.profile') }}</h4>
            </div>
            <div class="card-body p-4">
                <form wire:submit.prevent="save">
                    <div class="form-group mb-3">
                        <label for="nom" class="font-weight-bold">{{ __('ui.name') }}</label>
                        <input type="text" class="form-control" wire:model="editing.nom" id="nom" />
                        @error('editing.nom') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="email" class="font-weight-bold">{{ __('ui.email_address') }}</label>
                        <input type="email" class="form-control" wire:model="editing.email" id="email" />
                        @error('editing.email') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password" class="font-weight-bold">{{ __('ui.password') }} <small class="text-muted">(Laissez vide pour conserver le mot de passe actuel)</small></label>
                        <input type="password" class="form-control" wire:model="newPassword" id="password" placeholder="Nouveau mot de passe" />
                        @error('newPassword') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <button class="btn btn-primary btn-block mt-4" type="submit">
                        <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('ui.save') }}
                    </button>

                    @if ($saved) 
                        <div class="alert alert-success mt-3 mb-0 text-center">
                            Profil mis à jour avec succès.
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>