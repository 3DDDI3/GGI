<div class="input_block {{$class}}" @if (isset($display) && $display) style="display: {{$display}};" @endif>
    <span>{{$title ?? ''}}</span>
    <button type="button" class="button js-modal-search-checkboxes" data-url="{{$url}}" data-class="{{$class}}" data-id="{{$id ?? ''}}">
        Редактировать
    </button>
    <input type="hidden" name="{{$name}}" value="{{$value ?? ''}}">
</div>
