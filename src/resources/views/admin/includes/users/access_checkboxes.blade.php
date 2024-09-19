<div class="input_block">
    <span>{{$section['name']}}</span>
    <div class="list_item-flex row-checkboxes">
        {!! \App\Helpers\GenerateForm::makeMultipleCheckbox('rights['.$path.']', in_array('read', $section['rights']), 'Чтение', 1, uniqid() , 'read' ) !!}
        {!! \App\Helpers\GenerateForm::makeMultipleCheckbox('rights['.$path.']', in_array('edit', $section['rights']), 'Редактирование', 1, uniqid() , 'edit' ) !!}
        {!! \App\Helpers\GenerateForm::makeMultipleCheckbox('rights['.$path.']', in_array('delete', $section['rights']), 'Удаление', 1, uniqid() , 'delete' ) !!}
    </div>
</div>
