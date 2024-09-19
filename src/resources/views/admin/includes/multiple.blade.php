<fieldset class="checkbox-multiple">
    <legend>{{ $label ?? '' }}</legend>
    <div class="input_block">
        @if (!empty($list))
            @php
                $value = trim($value, '|');
                $array = explode("|", $value);

                $all = false;
                if (in_array(0, $array) || empty($array) || empty($value)) {
                    if (empty($all_default_off)) $all = true;
                }

                $id = 'checkbox_'.$name.'_0'.md5(uniqid(rand(), true));
            @endphp

            @if (empty($all_btn_off))
                <div class="checkbox_block checkbox_block_all">
                    <input type="checkbox" name="{{ $name }}[]"
                           id="{{ $id }}" class="inp-cbx checkbox-multiple-block-all" style="display: none;"
                           value="0" {{ $all ? 'checked' : '' }}>

                    <label class="cbx" for="{{ $id }}">
                        <span>
                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                              <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                            </svg>
                        </span>
                        <span>
                            Все
                        </span>
                    </label>
                </div>
            @endif

            @foreach ($list AS $item)
                @php
                    $id = 'checkbox_'.$name.'_'.$loop->iteration.'_'.$item->id;
                @endphp
                <div class="checkbox_block">
                    <input type="checkbox" name="{{ $name }}[]"
                           id="{{ $id }}" class="inp-cbx checkbox-multiple-block" style="display: none;"
                           value="{{ $item->id }}" {{ in_array($item->id, $array) || $all ? 'checked' : '' }}>

                    <label class="cbx" for="{{ $id }}">
                        <span>
                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                              <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                            </svg>
                        </span>
                        <span>
                            {{ $item->name ?? '' }}

                            <i class="checkbox-multiple-short">
                                @if (!empty($short))
                                    ({{ $item->{$short} ?? '' }})
                                @endif
                            </i>
                        </span>
                    </label>
                </div>
            @endforeach
        @endif
    </div>
</fieldset>
