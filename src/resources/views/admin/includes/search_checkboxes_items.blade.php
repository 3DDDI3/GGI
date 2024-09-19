@foreach($objects as $value)
    <div class="search-checkboxes__item checkbox_block">
        <label class="cbx">
            <input type="checkbox" class="inp-cbx" name="search-checkbox" hidden="hidden" value="{{$value->id}}" @if ($value->checked) checked="checked" @endif>
            <span class="cbx-body">
                                <svg width="12px" height="10px" viewBox="0 0 12 10">
                                  <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                </svg>
                            </span>
            <span>{{$value->name}}</span>
        </label>
        @if (isset($textboxes) && $textboxes)
        <textarea name="search-textbox" id="" cols="10" rows="3">{{$value->text ?? ''}}</textarea>
        @endif
    </div>
@endforeach
