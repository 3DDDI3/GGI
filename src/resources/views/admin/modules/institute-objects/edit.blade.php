@extends('admin.app')
@section('content')

    @include('admin.includes.h1')


    <div class="admin_edit_block">

        @include('admin.includes.back')

        <form  method="post" enctype="multipart/form-data" class="admin_edit-form">
            @csrf

            @include('admin.includes.input', ['label' => 'Рейтинг (для сортировки):', 'name' => 'rating', 'value' => $object->rating ?? ''])

            @include('admin.includes.input', ['label' => 'Координаты:', 'name' => 'coordinates', 'value' => $object->coordinates ?? '', 'required' => 'required'])
            
            @include('admin.includes.input', ['label' => 'Локация:', 'name' => 'location', 'value' => $object->location ?? ''])
            @include('admin.includes.input', ['label' => 'Заголовок:', 'name' => 'title', 'value' => $object->title ?? ''])
            @include('admin.includes.textbox', ['label' => 'Текст:', 'name' => 'text', 'value' => $object->text ?? ''])


            <x-Admin.Accordion title="Английская версия">
                @include('admin.includes.input', ['label' => 'Локация:', 'name' => 'location_en', 'value' => $object->location_en ?? ''])
                @include('admin.includes.input', ['label' => 'Заголовок:', 'name' => 'title_en', 'value' => $object->title_en ?? ''])
                @include('admin.includes.textbox', ['label' => 'Текст:', 'name' => 'text_en', 'value' => $object->text_en ?? ''])
            </x-Admin.Accordion>

            @include('admin.includes.errors')
            @include('admin.includes.submit')
        </form>
    </div>


@endsection
