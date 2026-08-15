<div>
    <x-table.controls name="Site" perPage="{{ $perPage }}" />

    <div class="row">
        <div wire:poll.10s class="col-lg-12">
            <x-table>
                <x-slot name="head">
                    <x-table.row>
                        <x-table.heading direction="null">
                            <x-input.checkbox wire:model="selectPage" />
                        </x-table.heading>
                        <x-table.heading sortable wire:click="sortBy('name')" :direction="$sorts['name'] ?? null" class="col-2">{{ __('ui.name') }}</x-table.heading>
                        <x-table.heading class="col"/>
                    </x-table.row>

                    @if($showFilters)
                        <x-table.row>
                            <x-table.heading direction="null">
                                <x-input.checkbox />
                            </x-table.heading>
                            <x-table.heading class="col-2" direction="null"><x-input.text wire:model="filters.name" class="form-control-sm p-0" /></x-table.heading>
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
                                            <span>Vous avez sélectionné <strong> {{ $locations->count() }} </strong> sites, voulez-vous tous les sélectionner (<strong> {{ $locations->total() }} </strong>) ?</span>
                                            <x-button.link wire:click="selectAll">{{ __('ui.select_all') }}</x-button.link>
                                        </div>
                                    @else
                                        <span>Tous les <strong> {{ $locations->total() }} </strong> sites sont sélectionnés.</span>
                                    @endif
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endif

                    @forelse ($locations as $location)
                        <x-table.row wire:key="row-{{ $location->id }}">
                            <x-table.cell >
                                <x-input.checkbox wire:model="selected" value="{{ $location->id }}"></x-input.checkbox>
                            </x-table.cell>
                            <x-table.cell class="col-2"><x-link route="locations" id="{{ $location->id }}" value="{{ $location->name }}"></x-link></x-table.cell>
                            <x-table.cell class="col">
                                <x-button.primary wire:click="edit({{ $location->id }})" ><x-loading wire:target="edit({{ $location->id }})" />{{ __('ui.edit') }}</x-button.primary>
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell width="12">
                                <div class="d-flex justify-content-center">
                                    Aucun site trouvé
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>

            <x-table.pagination-summary :model="$locations" />
        </div>
    </div>

    <!-- Delete Modal -->
    <form wire:submit.prevent="deleteSelected">
        <x-modal.dialog type="confirmModal">
            <x-slot name="title">Supprimer les sites</x-slot>

            <x-slot name="content">
                Êtes-vous sûr de vouloir supprimer ces sites ? Cette action est irréversible.
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
            <x-slot name="title">{{ $modalType == 'Create' ? 'Créer un' : 'Modifier le' }} Site</x-slot>

            <x-slot name="content">
                <x-input.group for="name" label="{{ __('ui.name') }}" :error="$errors->first('editing.name')">
                    <x-input.text wire:model.defer="editing.name" id="name" />
                </x-input.group>
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$emit('hideModal','edit')">{{ __('ui.cancel') }}</x-button.secondary>
                <x-button.primary type="submit">{{ __('ui.save') }}</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>
</div>