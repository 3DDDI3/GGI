@if (\App\Helpers\Admin\Helper::checkRights(\Request::url(), 'delete'))
    <a href="?delete={{ $object->id ?? 0 }}" class="admin_delete" title="Удалить"></a>
@endif
