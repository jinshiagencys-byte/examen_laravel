<div>
    <x-table.controls name="Problème de matériel" perPage="{{ $perPage }}" />

    <div class="row">
        <div wire:poll.10s class="col-lg-12">
            <x-table>
                <x-slot name="head">
                    <x-table.row>
                        <x-table.heading direction="null">
                            <x-input.checkbox wire:model="selectPage" />
                        </x-table.heading>
                        <x-table.heading sortable wire:click="sortBy('title')" :direction="$sorts['title'] ?? null" class="col-2">Titre</x-table.heading>
                        <x-table.heading sortable wire:click="sortBy('cost')" :direction="$sorts['cost'] ?? null" class="col-2">Coût</x-table.heading>
                        <x-table.heading class="col"/>
                    </x-table.row>

                    @if($showFilters)
                        <x-table.row>
                            <x-table.heading direction="null">
                                <x-input.checkbox />
                            </x-table.heading>
                            <x-table.heading class="col-2" direction="null"><x-input.text wire:model="filters.title" class="form-control-sm p-0" /></x-table.heading>
                            <x-table.heading class="col-2" direction="null"><x-input.text wire:model="filters.cost" class="form-control-sm p-0" /></x-table.heading>
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
                                            <span>Vous avez sélectionné <strong> {{ $equipmentIssues->count() }} </strong> problèmes, voulez-vous tous les sélectionner (<strong> {{ $equipmentIssues->total() }} </strong>) ?</span>
                                            <x-button.link wire:click="selectAll">{{ __('ui.select_all') }}</x-button.link>
                                        </div>
                                    @else
                                        <span>Tous les <strong> {{ $equipmentIssues->total() }} </strong> problèmes de matériel sont sélectionnés.</span>
                                    @endif
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endif

                    @forelse ($equipmentIssues as $equipmentIssue)
                        <x-table.row wire:key="row-{{ $equipmentIssue->id }}">
                            <x-table.cell>
                                <x-input.checkbox wire:model="selected" value="{{ $equipmentIssue->id }}"></x-input.checkbox>
                            </x-table.cell>
                            <x-table.cell class="col-2"><x-link route="equipmentIssues" id="{{ $equipmentIssue->id }}" value="{{ $equipmentIssue->title }}"></x-link></x-table.cell>
                            <x-table.cell class="col-2">{{ $equipmentIssue->cost }}</x-table.cell>
                            <x-table.cell class="col">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <x-button.primary wire:click="edit({{ $equipmentIssue->id }})" ><x-loading wire:target="edit({{ $equipmentIssue->id }})" />{{ __('ui.edit') }}</x-button.primary>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell width="12">
                                <div class="d-flex justify-content-center">
                                    Aucun problème trouvé
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>

            <x-table.pagination-summary :model="$equipmentIssues" />
        </div>
    </div>

    <!-- Delete Modal -->
    <form wire:submit.prevent="deleteSelected">
        <x-modal.dialog type="confirmModal">
            <x-slot name="title">Supprimer les problèmes de matériel</x-slot>

            <x-slot name="content">
                Êtes-vous sûr de vouloir supprimer ces éléments ? Cette action est irréversible.
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
            <x-slot name="title">{{ $modalType == 'Create' ? 'Créer un' : 'Modifier le' }} Problème de matériel</x-slot>

            <x-slot name="content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Title -->
                        <x-input.group label="Titre" for="title" :error="$errors->first('editing.title')">
                            <x-input.text wire:model.defer="editing.title" id="title" rows="8" />
                        </x-input.group>

                        <!-- Cost -->
                        <x-input.group label="Coût" for="cost" :error="$errors->first('editing.cost')">
                            <x-input.text wire:model.defer="editing.cost" id="cost" rows="8" />
                        </x-input.group>
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