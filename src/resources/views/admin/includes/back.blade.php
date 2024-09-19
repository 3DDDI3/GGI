<div class="admin_edit-links">
    <a href="{{ route('admin.'.$path.'.index') }}">Назад к списку</a>
    @if (!empty($site_link))
        <a href="{{ $site_link }}" target="_blank">Смотреть на сайте</a>
    @endif
</div>
