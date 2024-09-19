@extends('admin.app')
@section('content')

        @include('admin.includes.h1')


        <div class="admin_edit_block">

            @include('admin.includes.back')

            <form  method="post" enctype="multipart/form-data" class="admin_edit-form">
                @csrf

                @include('admin.includes.input', ['label' => 'Название:', 'name' => 'name', 'value' => $object->name ?? '', 'required' => 'required'])

                {!! \App\Helpers\GenerateForm::makeImage('Изображение', 'image' , $object , '/storage/'.$object->image) !!}

                {!! \App\Helpers\GenerateForm::makeFile('Файл', 'path' , $object , '/storage/'.$object->path) !!}

                {{-- @include('admin.includes.input', ['label' => 'Cсылка (автоматически):', 'name' => 'link', 'value' => $object->link ?? '']) --}}

                @include('admin.includes.input', ['label' => 'Рейтинг (для сортировки):', 'name' => 'rating', 'value' => $object->rating ?? ''])

                <x-Admin.Accordion title="Английская версия">
                    @include('admin.includes.input', ['label' => 'Название:', 'name' => 'name_en', 'value' => $object->name_en ?? ''])
                </x-Admin.Accordion>

                @include('admin.includes.errors')
                @include('admin.includes.submit')
            </form>
        </div>


@endsection