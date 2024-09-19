@extends('admin.app')
@section('content')

        @include('admin.includes.h1')

        <div class="admin_edit_block">
            @include('admin.includes.back')

            <form  method="post" enctype="multipart/form-data" class="admin_edit-form">
                @csrf

                @include('admin.includes.input', ['label' => 'Название:', 'name' => 'name', 'value' => $object->name ?? '', 'required' => 'required'])

                @foreach ($admin_sections as $path => $admin_section)
                    @if (isset($admin_section['children']))
                        <fieldset class="js-fieldset">
                            <legend>{{$admin_section['name']}}</legend>
                            <div class="input_block">
                                <span>Все</span>
                                <div class="list_item-flex row-checkboxes js-all-checkboxes">
                                    {!! \App\Helpers\GenerateForm::makeMultipleCheckbox('', false, 'Чтение', 1, uniqid() , 'read' ) !!}
                                    {!! \App\Helpers\GenerateForm::makeMultipleCheckbox('', false, 'Редактирование', 1, uniqid() , 'edit' ) !!}
                                    {!! \App\Helpers\GenerateForm::makeMultipleCheckbox('', false, 'Удаление', 1, uniqid() , 'delete' ) !!}
                                </div>
                            </div>
                            @foreach ($admin_section['children'] as $path2 => $child)
                                @include('admin.includes.users.access_checkboxes', ['section' => $child, 'path' => $path2])
                            @endforeach
                        </fieldset>
                    @else
                        @include('admin.includes.users.access_checkboxes', ['section' => $admin_section, 'path' => $path])
                    @endif
                @endforeach

                @include('admin.includes.submit')
            </form>
        </div>

@endsection

@section('custom_script')
    <script>
        $('.js-all-checkboxes').find('input[type="checkbox"]').on('change', function(){
           var fieldset = $(this).closest('.js-fieldset');
           var index = $(this).closest('.js-all-checkboxes').find('.checkbox_block').index($(this).closest('.checkbox_block')) + 1;

           fieldset.find('.checkbox_block:nth-child('+index+') input[type="checkbox"]').prop('checked', $(this).is(':checked')?'checked':'');
        });
    </script>
@endsection
