@php
    if (!isset($field) || !$field) $field='text';
@endphp
<div class="construct-box js-construct-box" data-name='{{$name}}'>
    <input class="js-construct-box__edit" type="hidden" name="{{$name}}_edit" value="0">
        @if (isset($types) && !empty($types))
            <div class="construct-box__grid">
                @foreach ($types as $value)
                    <div class="construct-box__column construct-box-column js-construct-box-column" data-parent-id="{{$value['id']}}">
                        <div class="construct-box-column__head">
                            <span class="construct-box-column__title">{{$value['name']}}</span>
                        </div>
                        <div class="construct-box-column__body js-construct-box-column__body">
                             @php
                                 $items = $object->$name()->where($type_id_name, $value['id'])->get();
                             @endphp
                            @if (!empty($items))
                                @foreach ($items as $value2)
                                    <div class="construct-box-column__item js-construct-box-column__item">
                                        <textarea name="{{$name}}[{{$value['id']}}][{{$value2['id']}}]">{{$value2[$field]}}</textarea>
                                        <button type="button" class="construct-box-column__delete js-construct-box-column__delete"></button>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <button type="button" class="construct-box-column__add button js-construct-box-column__add">+ Добавить</button>
                    </div>
                @endforeach
            </div>
        @else
            <div class="construct-box__column construct-box-column js-construct-box-column">
                <div class="construct-box-column__body js-construct-box-column__body">
                    @php
                        $items = $object[$name];
                    @endphp
                    @if (!empty($items))
                        @foreach ($items as $value)
                            <div class="construct-box-column__item js-construct-box-column__item">
                                <textarea name="{{$name}}[{{$value['id']}}]">{{$value[$field]}}</textarea>
                                <button type="button" class="construct-box-column__delete js-construct-box-column__delete"></button>
                            </div>
                        @endforeach
                    @endif
                </div>
                <button type="button" class="construct-box-column__add button js-construct-box-column__add">+ Добавить</button>
            </div>
        @endif
</div>
