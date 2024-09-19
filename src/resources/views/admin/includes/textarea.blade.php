<div class="input_block">
    <span>{{ $label ?? '' }}</span>
    <textarea type="text" name="{{ $name ?? '' }}" {{ $required ?? '' }}>{{ $value ?? '' }}</textarea>
    @if (!empty($help))
        <small class="help-textarea">{{ $help }}</small>
    @endif
</div>
