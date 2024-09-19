@if (!empty($object->id))
    <x-admin.accordion title="Характеристики товара">
        @if (!empty($catalog_chars))
            <div class="catalog-chars">
                @foreach($catalog_chars AS $char)

                    @php
                        $char_id = $char->id ?? 0;
                        $char_field = $char->field ?? 0;
                        $char_type = $char->type ?? 0;
                        if ($char_field == 'price') continue;
                        $char_name = $char->name ?? '';
                        $values = $catalog_chars_products[$char_id] ?? array();
                        $values_first = @$values[0]->value ?? '';
                        $value = '|';
                        foreach ($values AS $item) {
                            $value .= $item->value.'|';
                        }
                        $items = $catalog_chars_value[$char_id] ?? array();
                    @endphp

                    @if ($char_type == 1)
                        <fieldset class="checkbox-multiple">
                            <legend>{{ $char->name }}</legend>
                            @include('admin.includes.input', ['label' => '', 'name' => 'catalog_chars_input_value[]', 'value' => $values_first ?? ''])
                            <input type="hidden" name="catalog_chars_input_value_id[]" value="{{ $char->id ?? 0 }}">
                        </fieldset>
                    @else
                        @include('admin.includes.multiple', ['label'=>$char_name, 'name'=>'catalog_chars_value', 'value'=>$value, 'list'=> $items, 'all_default_off'=>true])
                    @endif

                @endforeach
            </div>
        @endif

    </x-admin.accordion>
@endif
