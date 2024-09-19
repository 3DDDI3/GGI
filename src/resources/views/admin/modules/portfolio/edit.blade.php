@extends('admin.app')
@section('content')

        @include('admin.includes.h1')

        <div class="admin_edit_block">
            @include('admin.includes.back')

            <form  method="post" enctype="multipart/form-data" class="admin_edit-form">
                @csrf

                {!! \App\Helpers\GenerateForm::makeCheckbox('hide', (!$object->hide) , 'Показывать') !!}

                @include('admin.includes.input', ['label' => 'Заголовок', 'name' => 'name', 'value' => $object->name ?? '', 'required' => 'required'])
                
                {!! \App\Helpers\GenerateForm::makeImage('Изображение (200X170)', 'image' , $object , '/storage/'.$object->image) !!}

                @include('admin.includes.textbox', ['label' => 'Текст:', 'name' => 'text', 'value' => $object->text ?? ''])

                @include('admin.includes.input', ['label' => 'Рейтинг (для сортировки):', 'name' => 'rating', 'value' => $object->rating ?? ''])


                @include('admin.includes.filebox', ['name' => 'files_doc', 'item_type' => 'portfolio', 'object' => $object])

                <x-Admin.Accordion title="Английская версия">
                    @include('admin.includes.input', ['label' => 'Название:', 'name' => 'name_en', 'value' => $object->name_en ?? ''])
                    @include('admin.includes.textbox', ['label' => 'Текст:', 'name' => 'text_en', 'value' => $object->text_en ?? ''])
                </x-Admin.Accordion>

                @include('admin.includes.submit')
            </form>
        </div>

@endsection
