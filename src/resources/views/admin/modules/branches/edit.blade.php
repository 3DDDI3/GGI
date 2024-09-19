@extends('admin.app')
@section('content')

    @include('admin.includes.h1')


    <div class="admin_edit_block">

        @include('admin.includes.back')

        <form  method="post" enctype="multipart/form-data" class="admin_edit-form">
            @csrf


            @include('admin.includes.input', ['label' => 'Название:', 'name' => 'name', 'value' => $object->name ?? '', 'required' => 'required'])
            @include('admin.includes.textarea', ['label' => 'Описание:', 'name' => 'description', 'value' => $object->description ?? ''])
            @include('admin.includes.input', ['label' => 'Наши координаты:', 'name' => 'coordinates', 'value' => $object->coordinates ?? ''])


            {!! \App\Helpers\GenerateForm::makeImage('Изображение (220x150)', 'image' , $object , '/storage/'.$object->image) !!}


            @include('admin.includes.textbox', ['label' => 'Текст:', 'name' => 'text', 'value' => $object->text ?? ''])

            @include('admin.includes.input', ['label' => 'Телефон:', 'name' => 'phone', 'value' => $object->phone ?? ''])
            @include('admin.includes.input', ['label' => 'Факс:', 'name' => 'fax', 'value' => $object->fax ?? ''])
            @include('admin.includes.input', ['label' => 'Адреса электронной почты (через запятую):', 'name' => 'email', 'value' => $object->email ?? ''])
            @include('admin.includes.input', ['label' => 'Адрес:', 'name' => 'address', 'value' => $object->address ?? ''])

            @include('admin.includes.textbox', ['label' => 'Текст 2:', 'name' => 'text2', 'value' => $object->text2 ?? ''])


            @include('admin.includes.input', ['label' => 'Ссылка (автоматически):', 'name' => 'link', 'value' => $object->link ?? ''])

            @include('admin.includes.input', ['label' => 'Рейтинг (для сортировки):', 'name' => 'rating', 'value' => $object->rating ?? ''])

            <x-Admin.Accordion title="Английская версия">
                @include('admin.includes.input', ['label' => 'Название:', 'name' => 'name_en', 'value' => $object->name_en ?? ''])
                @include('admin.includes.textarea', ['label' => 'Описание:', 'name' => 'description_en', 'value' => $object->description_en ?? ''])
                @include('admin.includes.textbox', ['label' => 'Текст:', 'name' => 'text_en', 'value' => $object->text_en ?? ''])

                @include('admin.includes.textbox', ['label' => 'Текст 2:', 'name' => 'text2_en', 'value' => $object->text2_en ?? ''])

            </x-Admin.Accordion>

            @include('admin.includes.errors')
            @include('admin.includes.submit')
        </form>
    </div>


@endsection
