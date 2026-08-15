<div>
    <x-table.controls name="Utilisateur" perPage="{{ $perPage }}" />

    <div class="row">
        <div wire:poll.10s class="col-lg-12">
            <x-table>
                <x-slot name="head">
                    <x-table.row>
                        <x-table.heading direction="null">
                            <x-input.checkbox wire:model="selectPage" />
                        </x-table.heading>
                        <x-table.heading sortable wire:click="sortBy('user_full_name')" :direction="$sorts['user_full_name'] ?? null" class="col-3">{{ __('ui.user') }}</x-table.heading>
                        <x-table.heading sortable wire:click="sortBy('email')" :direction="$sorts['email'] ?? null" class="col">{{ __('ui.email_address') }}</x-table.heading>
                        <x-table.heading class="col-2"/>
                    </x-table.row>

                    @if($showFilters)
                        <x-table.row>
                            <x-table.heading direction="null">
                                <x-input.checkbox />
                            </x-table.heading>
                            <x-table.heading class="col-3" direction="null"><x-input.text wire:model="filters.user_id" class="form-control-sm p-0" /></x-table.heading>
                            <x-table.heading class="col" direction="null"><x-input.text wire:model="filters.email" class="form-control-sm p-0" /></x-table.heading>
                            <x-table.heading class="col-2" direction="null"/>
                        </x-table.row>
                    @endif
                </x-slot>

                <x-slot name="body">
                    @if($selectPage)
                        <x-table.row>
                            <x-table.cell width="12">
                                <div class="d-flex justify-content-center">
                                    @unless($selectAll)
                                        <div>
                                            <span>Vous avez sélectionné <strong> {{ $users->count() }} </strong> utilisateurs, voulez-vous tous les sélectionner (<strong> {{ $users->total() }} </strong>) ?</span>
                                            <x-button.link wire:click="selectAll">{{ __('ui.select_all') }}</x-button.link>
                                        </div>
                                    @else
                                        <span>Tous les <strong> {{ $users->total() }} </strong> utilisateurs sont sélectionnés.</span>
                                    @endif
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endif

                    @forelse ($users as $user)
                        <x-table.row wire:key="row-{{ $user->id }}">
                            <x-table.cell >
                                <x-input.checkbox wire:model="selected" value="{{ $user->id }}"></x-input.checkbox>
                            </x-table.cell>
                            <x-table.cell class="col-3"><x-link route="users" id="{{ $user->id }}" value="{{ $user->nom }}"></x-link></x-table.cell>
                            <x-table.cell class="col">{{ $user->email }}</x-table.cell>
                            <x-table.cell class="col-2">
                                <x-button.primary wire:click="edit({{ $user->id }})" ><x-loading wire:target="edit({{ $user->id }})" />{{ __('ui.edit') }}</x-button.primary>
                                @if($user->has_account)
                                    <x-button.danger wire:click="resetPassword({{ $user->id }})" ><x-loading wire:target="resetPassword({{ $user->id }})" />Réinitialiser mot de passe</x-button.danger>
                                @endif
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell width="12">
                                <div class="d-flex justify-content-center">
                                    Aucun utilisateur trouvé
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>

            <x-table.pagination-summary :model="$users" />
        </div>
    </div>

    <!-- Delete Modal -->
    <form wire:submit.prevent="deleteSelected">
        <x-modal.dialog type="confirmModal">
            <x-slot name="title">Supprimer les utilisateurs</x-slot>

            <x-slot name="content">
                Êtes-vous sûr de vouloir supprimer ces utilisateurs ? Cette action est irréversible.
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$emit('hideModal','confirm')">{{ __('ui.cancel') }}</x-button.secondary>
                <x-button.danger type="submit">{{ __('ui.delete') }}</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>

    <!-- Create/Edit Modal -->
    <form wire:submit.prevent="save">
        <x-modal.dialog type="editModal">
            <x-slot name="title">{{ $modalType == 'Create' ? 'Créer un' : 'Modifier l\'' }} Utilisateur</x-slot>

            <x-slot name="content">
                <x-input.group for="nom" label="{{ __('ui.name') }}" :error="$errors->first('editing.nom')">
                    <x-input.text wire:model.defer="editing.nom" id="nom" />
                </x-input.group>

                <x-input.group for="email" label="{{ __('ui.email_address') }}" :error="$errors->first('editing.email')">
                    <x-input.text wire:model.defer="editing.email" id="email" />
                </x-input.group>

                <x-input.group for="has_account" label="Compte actif" :error="$errors->first('editing.has_account')">
                    <x-input.checkbox wire:model.defer="editing.has_account" id="has_account" />
                </x-input.group>
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$emit('hideModal','edit')">{{ __('ui.cancel') }}</x-button.secondary>
                <x-button.primary type="submit">{{ __('ui.save') }}</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>
</div>