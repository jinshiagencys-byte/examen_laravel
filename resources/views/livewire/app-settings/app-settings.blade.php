<form wire:submit.prevent="save">
    <div class="row mt-3">
        <div class="col-md-6 offset-md-3">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white text-center">
                    <h4 class="m-0"><i class="fa-solid fa-envelope mr-2"></i> Configuration Email</h4>
                </div>
                <div class="card-body">
                    <x-input.group class="" for="mailer" label="Serveur Mailer" :error="$errors->first('mail.mailer')">
                        <x-input.text class="form-control-full-width" wire:model="mail.mailer" id="mailer" />
                    </x-input.group>

                    <x-input.group class="" for="host" label="Hôte (Host)" :error="$errors->first('mail.host')">
                        <x-input.text class="form-control-full-width" wire:model="mail.host" id="host" />
                    </x-input.group>

                    <x-input.group class="" for="port" label="Port" :error="$errors->first('mail.port')">
                        <x-input.text class="form-control-full-width" wire:model="mail.port" id="port" />
                    </x-input.group>

                    <x-input.group class="" for="username" label="Nom d'utilisateur" :error="$errors->first('mail.username')">
                        <x-input.text class="form-control-full-width" wire:model="mail.username" id="username" />
                    </x-input.group>

                    <x-input.group class="" for="password" label="Mot de passe" :error="$errors->first('mail.password')">
                        <x-input.text type="password" class="form-control-full-width" wire:model="mail.password" id="password" />
                    </x-input.group>

                    <x-input.group class="" for="encryption" label="Chiffrement (Encryption)" :error="$errors->first('mail.encryption')">
                        <x-input.text class="form-control-full-width" wire:model="mail.encryption" id="encryption" />
                    </x-input.group>

                    <x-input.group class="" for="from_address" label="Adresse d'expédition" :error="$errors->first('mail.from_address')">
                        <x-input.text class="form-control-full-width" wire:model="mail.from_address" id="from_address" />
                    </x-input.group>

                    <x-input.group class="" for="cc_address" label="Adresse Copie (CC)" :error="$errors->first('mail.cc_address')">
                        <x-input.text class="form-control-full-width" wire:model="mail.cc_address" id="cc_address" />
                    </x-input.group>

                    <x-input.group class="" for="reply_to_address" label="Adresse de réponse (Reply-To)" :error="$errors->first('mail.reply_to_address')">
                        <x-input.text class="form-control-full-width" wire:model="mail.reply_to_address" id="reply_to_address" />
                    </x-input.group>

                    <button class="btn btn-primary btn-block mt-4" type="submit">
                        <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('ui.save') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
