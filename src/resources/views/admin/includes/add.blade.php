@if (\App\Helpers\Admin\Helper::checkRights(\Request::url(), 'edit'))
    <div class="filter">
        <a href="{{ route('admin.'.$path.'.edit') }}" class="admin_add">Добавление {{ $title[1] ?? '' }}</a>
    </div>
@endif
