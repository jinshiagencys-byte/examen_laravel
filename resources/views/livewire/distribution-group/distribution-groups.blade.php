<div>
    <x-table.controls name="Distribution Group" perPage="{{ $perPage }}" />

    <div class="row">
        <div wire:poll.10s class="col-lg-12">
            <x-table>
                <x-slot name="head">
                    <x-table.row>
                        <x-table.heading direction="null">
                            <x-input.checkbox wire:model="selectPage" />
                        </x-table.heading>
                        <x-table.heading sortable wire:click="sortBy('name')" :direction="$sorts['name'] ?? null" class="col-2">Nom</x-table.heading>
                        <x-table.heading class="col-2">Utilisateurs</x-table.heading>
                        <x-table.heading class="col"/>
                    </x-table.row>

                    @if($showFilters)
                        <x-table.row>
                            <x-table.heading direction="null">
                                <x-input.checkbox />
                            </x-table.heading>
                            <x-table.heading class="col-2" direction="null"><x-input.text wire:model="filters.name" class="form-control-sm p-0" /></x-table.heading>
                            <x-table.heading class="col-2" direction="null"><x-input.text wire:model="filters.users" class="form-control-sm p-0" /></x-table.heading>
                            <x-table.heading class="col" direction="null"/>
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
                                            <span>Vous avez sélectionné <strong> {{ $distributionGroups->count() }} </strong> groupes de distribution, voulez-vous sélectionner tous les <strong> {{ $distributionGroups->total() }} </strong> ?</span>
                                            <x-button.link wire:click="selectAll">Tout sélectionner</x-button.link>
                                        </div>
                                    @else
                                        <span>Vous avez sélectionné tous les <strong> {{ $distributionGroups->total() }} </strong> groupes de distribution.</span>
                                    @endif
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endif

                    @forelse ($distributionGroups as $distributionGroup)
                        <x-table.row wire:key="row-{{ $distributionGroup->id }}">
                            <x-table.cell>
                                <x-input.checkbox wire:model="selected" value="{{ $distributionGroup->id }}"></x-input.checkbox>
                            </x-table.cell>
                            <x-table.cell class="col-2"><x-link route="distributionGroups" id="{{ $distributionGroup->id }}" value="{{ $distributionGroup->name }}"></x-link></x-table.cell>
                            <x-table.cell class="col-2">
                                @foreach($distributionGroup->users as $user)
                                    <x-link route="users" id="{{ $user->id }}" value="{{ $user->nom }}"></x-link><br>
                                @endforeach
                            </x-table.cell>
                                    <x-table.cell class="col">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <x-button.primary wire:click="edit({{ $distributionGroup->id }})" ><x-loading wire:target="edit({{ $distributionGroup->id }})" />Modifier</x-button.primary>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell width="12">
                                <div class="d-flex justify-content-center">
                                    Aucun groupe de distribution trouvé
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>

            <x-table.pagination-summary :model="$distributionGroups" />
        </div>
    </div>

    <!-- Delete Modal -->
    <form wire:submit.prevent="deleteSelected">
        <x-modal.dialog type="confirmModal">
            <x-slot name="title">Supprimer les groupes de distribution</x-slot>

            <x-slot name="content">
                Êtes-vous sûr de vouloir supprimer ces groupes de distribution ? Cette action est irréversible.
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$emit('hideModal','confirm')">Annuler</x-button.secondary>
                <x-button.danger type="submit">Supprimer</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>

    <!-- Create/Edit Modal -->
    <form wire:submit.prevent="save">
        <x-modal.dialog type="editModal" class="modal-xl">
            <x-slot name="title">{{ $modalType }} Groupe de distribution</x-slot>

            <x-slot name="content">
                <div class="row">
                    <div class="col-md-6">
                        <!-- Name -->
                        <x-input.group label="Nom" for="name" :error="$errors->first('editing.name')">
                            <x-input.text wire:model.defer="editing.name" id="name" rows="8" />
                        </x-input.group>

                        <!-- Users -->
                        <x-input.group label="Utilisateurs" for="user_id" :error="$errors->first('user_id')">
                            <x-input.select wire:model="user_id" id="user_id" clearSelection disabledSelected iteration="{{ $iteration }}" placeholder="Sélectionner un utilisateur" fullWidth inModal>
                                @foreach ($equipmentList as $user)
                                    @if($user['avaliable'] == true)
                                        <option value="{{ $user['id'] }}">{{ $user['forename'] }} {{ $user['surname'] }}</option>
                                    @else
                                        <option value="{{ $user['id'] }}" disabled>{{ $user['forename'] }} ({{ $user['surname'] }})</option>
                                    @endif
                                @endforeach
                            </x-input.select>
                        </x-input.group>
                    </div>

                    <div class="col-md-6">
                        <!-- Shopping Cart -->
                        <div wire:model="shoppingCart" iteration="{{ $iteration }}">
                            <x-shoppingCart.group>
                                @foreach ($shoppingCart as $key => $user)
                                    <x-shoppingCart.cartCard id="{{ $user['id'] }}" name="{{ $user['forename'] }} {{ $user['surname'] }}" />
                                @endforeach
                            </x-shoppingCart.group>
                        </div>
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$emit('hideModal','edit')">{{ __('ui.cancel') }}</x-button.secondary>
                <x-button.primary type="submit">{{ __('ui.save') }}</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>
</div>