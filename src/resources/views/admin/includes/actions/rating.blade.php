@if (\App\Helpers\Admin\Helper::checkRights(\Request::url(), 'edit'))
    <input type='text' class='rating-change' value="{{ $object->rating }}" title="Рейтинг"
           data-id="{{ $object->id }}"
           data-class="{{ get_class($object) }}" placeholder='Рейтинг'>
@endif
