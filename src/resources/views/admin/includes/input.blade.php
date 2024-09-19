<div class="input_block">
    @if (!empty($label))
        <span>{!! $label ?? '' !!}</span>
    @endif
    <input type="{{(isset($type) && $type) ? $type : 'text'}}" name="{{ $name ?? '' }}" value="{{ $value ?? '' }}" {{ $required ?? '' }} class="{{ $class ?? '' }}" maxlength="191">
    @if (!empty($help))
        <small class="help-textarea">{{ $help }}</small>
    @endif
</div>
