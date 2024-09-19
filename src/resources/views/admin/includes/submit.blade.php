@if (\App\Helpers\Admin\Helper::checkRights(\Request::url(), 'edit'))
    <div class="input_block">
        <button type="submit">Сохранить</button>
    </div>
@endif
