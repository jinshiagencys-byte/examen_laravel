<div>
    <x-table.controls name="Asset" perPage="{{ $perPage }}" />

    <div class="row">
        <div wire:poll.10s class="col-lg-12">
            <x-table>
                <x-slot name="head">
                    <x-table.row>
                        <x-table.heading direction="null">
                            <x-input.checkbox wire:model="selectPage" />
                        </x-table.heading>
                        <x-table.heading sortable wire:click="sortBy('name')" :direction="$sorts['name'] ?? null" class="col-3">{{ __('ui.name') }}</x-table.heading>
                        <x-table.heading sortable wire:click="sortBy('tag')" :direction="$sorts['tag'] ?? null" class="col-1">{{ __('ui.tag') }}</x-table.heading>
                        <x-table.heading sortable wire:click="sortBy('description')" :direction="$sorts['description'] ?? null" class="col">Description</x-table.heading>
                        <x-table.heading class="col-2"/>
                    </x-table.row>

                    @if($showFilters)
                        <x-table.row>
                            <x-table.heading direction="null">
                                <x-input.checkbox />
                            </x-table.heading>
                            <x-table.heading class="col-3" direction="null"><x-input.text wire:model="filters.name" class="form-control-sm p-0" /></x-table.heading>
                            <x-table.heading class="col-1" direction="null"><x-input.text wire:model="filters.tag" class="form-control-sm p-0" /></x-table.heading>
                            <x-table.heading class="col" direction="null"><x-input.text wire:model="filters.description" class="form-control-sm p-0" /></x-table.heading>
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
                                            <span>{{ __('ui.selected_assets', ['count' => $assets->count()]) }}, {{ __('ui.select_all') }} <strong> {{ $assets->total() }} </strong>?</span>
                                            <x-button.link wire:click="selectAll">{{ __('ui.select_all') }}</x-button.link>
                                        </div>
                                    @else
                                        <span>You have selected all <strong> {{ $assets->total() }} </strong> assets.</span>
                                    @endif
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endif

                    @forelse ($assets as $asset)
                        <x-table.row wire:key="row-{{ $asset->id }}">
                            <x-table.cell >
                                <x-input.checkbox wire:model="selected" value="{{ $asset->id }}"></x-input.checkbox>
                            </x-table.cell>
                            <x-table.cell class="col-3"><x-link route="assets" id="{{ $asset->id }}" value="{{ $asset->name }}"></x-link></x-table.cell>
                            <x-table.cell class="col-1">{{ $asset->tag }}</x-table.cell>
                            <x-table.cell class="col" title="{{ $asset->description }}">
                                @if(strlen($asset->description) > 300 && !in_array('description-'.$asset->id, $expandedCells))
                                    {{ substr($asset->description, 0, 297) }}...
                                    <div><x-button.link wire:click.prevent="expandCell('description-{{ $asset->id }}')">{{ __('ui.show_more') }}</x-button.link></div>
                                @elseif(in_array('description-'.$asset->id, $expandedCells))
                                    {{ $asset->description }}
                                    <div><x-button.link wire:click.prevent="collapseCell('description-{{ $asset->id }}')">{{ __('ui.show_less') }}</x-button.link></div>
                                @else
                                    {{ $asset->description }}
                                @endif
                            </x-table.cell>
                            <x-table.cell class="col-2">
                                <x-button.primary wire:click="edit({{ $asset->id }})" ><x-loading wire:target="edit({{ $asset->id }})" />{{ __('ui.edit') }}</x-button.primary>
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell width="12">
                                    <div class="d-flex justify-content-center">
                                    {{ __('ui.no_assets_found') }}
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>

            <x-table.pagination-summary :model="$assets" />
        </div>
    </div>

    <!-- Delete Modal -->
    <form wire:submit.prevent="deleteSelected">
        <x-modal.dialog type="confirmModal">
            <x-slot name="title">{{ __('ui.delete_title', ['item' => 'Assets']) }}</x-slot>

            <x-slot name="content">
                {{ __('ui.delete_confirmation', ['item' => 'assets']) }}
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
            <x-slot name="title">{{ $modalType }} {{ __('ui.asset') }}</x-slot>

            <x-slot name="content">
                <x-input.group for="name" label="{{ __('ui.name') }}" :error="$errors->first('editing.name')">
                    <x-input.text wire:model.defer="editing.name" id="name" />
                </x-input.group>

                <x-input.group for="tag" label="{{ __('ui.tag') }}" :error="$errors->first('editing.tag')">
                    <x-input.text wire:model.defer="editing.tag" id="tag" />
                </x-input.group>

                <x-input.group for="description" label="{{ __('ui.description') }}" :error="$errors->first('editing.description')">
                    <x-input.textarea wire:model.defer="editing.description" id="description" />
                </x-input.group>
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$emit('hideModal','edit')">{{ __('ui.cancel') }}</x-button.secondary>
                <x-button.primary type="submit">{{ __('ui.save') }}</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>
</div>