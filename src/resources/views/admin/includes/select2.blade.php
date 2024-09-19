<div class="input_block">
    <span>{{ $label ?? '' }}1</span>

    @if (!empty($select))
        <select name='{{ $name ?? '' }}' class='chosen {{ $class ?? '' }}' {{isset($required) ? 'required' : ''}}>
            <option value='0'>{{ !empty($select_head) ? $select_head : 'Не выбрано' }}</option>
            @foreach ($select AS $option)

                <option value='{{ (!empty($value_name) ? $option->$value_name : null) ?? $option->id ?? 0 }}' {{ ($value ?? '') == ((!empty($value_name) ? $option->$value_name : null) ?? $option->id) ? 'selected' : '' }}>
                    @if ($name == 'user')
                        {{ !empty($option->email) ? $option->email : $option->name }}&nbsp;&nbsp;&nbsp;(ID: {{ $option->id ?? '' }}, ФИО: {{ $option->lastname ?? '' }} {{ $option->name ?? '' }} {{ $option->middlename ?? '' }})
                    @else
                        {{ (isset($name_name) ? $option->$name_name : null) ?? $option->name ?? '' }}
                    @endif
                </option>
            @endforeach
        </select>
    @endif
</div>
