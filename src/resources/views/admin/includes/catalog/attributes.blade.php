@if (!empty($object->id))
    <x-admin.accordion title="Атрибуты товара">

        @include('admin.includes.input', ['label' => 'Название кнопки открытия:', 'name' => 'attributes_button', 'value' => $object->attributes_button ?? ''])
        <br>

        @if (!empty($catalog_attributes))
            <div class="catalog-attributes">
                @foreach($catalog_attributes AS $attr)

                    @php
                        $attr_id = $attr->id ?? 0;
                        $attr_name = $attr->name ?? '';
                        $items = $catalog_attributes_products[$attr_id] ?? array();
                        $values = $catalog_attributes_value[$attr_id] ?? array();
                        $childs = $attr->childs;
                    @endphp

                    @include('admin.includes.items.items', [
                        'items' => $items,
                        'items_table' => 'catalog_attributes_products',
                        'items_type' => $attr_id,
                        'label' => $attr_name,
                        'childs' => $childs,
                        'values' => $values
                    ])

                @endforeach
            </div>
        @endif

        <fieldset>
            <legend>Кнопка-ссылка в окне атрибутов</legend>
            @include('admin.includes.input', ['label' => 'Название кнопки в окне:', 'name' => 'attributes_link_name', 'value' => $object->attributes_link_name ?? ''])
            @include('admin.includes.input', ['label' => 'Ссылка кнопки в окне:', 'name' => 'attributes_link', 'value' => $object->attributes_link ?? ''])
        </fieldset>

    </x-admin.accordion>
@endif
