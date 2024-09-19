<div class="input_block">
    <span>{{ $label ?? '' }}</span>
    <textarea name="{{ $name ?? '' }}" class="editor" id="editor_{{ $name ?? '' }}">{{ $value ?? '' }}</textarea>
</div>