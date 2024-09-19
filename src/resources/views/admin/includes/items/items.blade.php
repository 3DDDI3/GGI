@if (!empty($object->id))
    <fieldset>
        <legend>{{ $label ?? '' }}</legend>

        @php
            $items_count = 0;
        @endphp

        @if (!empty($childs))
            @if (count($childs) > 0)
                <div class="items-childs">
                    @foreach ($childs AS $child)
                        @php
                            $child_id = $child->id ?? 0;
                            $child_name = $child->name ?? '';
                            $child_items = $catalog_attributes_products[$child_id] ?? array();
                            $child_values = $catalog_attributes_value[$child_id] ?? array();
                        @endphp
                        @if (!empty($child_id) && !empty($child_name))
                            @include('admin.includes.items.items', [
                                'items' => $child_items,
                                'items_table' => $items_table,
                                'items_type' => $child_id,
                                'label' => $child_name,
                                'childs' => array(),
                                'child' => true,
                                'values' => $child_values
                            ])
                        @endif
                    @endforeach
                </div>
            @endif
        @endif

        <div class="items">
            @if (!empty($items))
                @php
                    $items_count = count($items);
                    if (empty($second)) $second = '';
                @endphp
                @foreach ($items AS $item)
                    @include('admin.includes.items.item', [
                        'item_id' => $item->id ?? '',
                        'item_value' => $item->name ?? '',
                        'item_value2' => $item->{$second} ?? '',
                        'table' => $items_table ?? '',
                        'type' => $items_type ?? '',
                        'values' => $values ?? array(),
                        'placeholder' => $placeholder ?? '',
                        'placeholder2' => $placeholder2 ?? '',
                        'second' => $second ?? '',
                        'item_show_preview' => $item->show_preview ?? '',
                        'item_show_storage_count_min' => $item->show_storage_count_min ?? '',
                        'field' => $object->field ?? '',
                    ])
                @endforeach
            @endif
        </div>

        @php
            $items_add_hide = false;
            if (!empty($child) && $items_count > 0) $items_add_hide = true;
        @endphp
        <div class="button items-add {{ $items_add_hide ? 'items-add-hide' : '' }}" data-id="{{ $object->id }}" data-table="{{ $items_table }}" data-type="{{ $items_type ?? '' }}">Добавить</div>

    </fieldset>
@endif
