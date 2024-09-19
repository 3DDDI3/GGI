@if (!empty($object->id) && !empty($catalog_storage))
    <x-Admin.Accordion title="Наличие на складах">
        @if (!empty($catalog_storage))
            <div class="column-items column-items2">
                <div class="column-item">
                    @php
                        $catalog_storage_count = count($catalog_storage);
                        $column_count = ceil($catalog_storage_count / 2);
                    @endphp
                    @foreach ($catalog_storage AS $storage)

                        @php
                            $label = $storage->name.':';
                            if ($storage->shop <> 1) $label = '<strong>'.$label.'</strong>';

                            $value = @$catalog_storage_products[$storage->id];
                        @endphp

                        @include('admin.includes.input', [
                            'label' => $label,
                            'name' => 'storage'.$storage->id,
                            'value' => $value,
                            'help' => $storage->address ?? '',
                            'class' => 'input-number'  
                        ])

                        @if ($loop->iteration == $column_count)
                            </div>
                            <div class="column-item">
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    </x-Admin.Accordion>
@endif
