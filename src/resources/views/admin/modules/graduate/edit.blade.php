@extends('admin.app')
@section('content')

        @include('admin.includes.h1')


        <div class="admin_edit_block">

            @include('admin.includes.back')

            <form  method="post" enctype="multipart/form-data" class="admin_edit-form">
                @csrf
                
                @php
                  
                @endphp
                {!! \App\Helpers\GenerateForm::makeRadio('Тип','model', $blockTypes, $object->model ) !!}
                {{-- {!! \App\Helpers\GenerateForm::makeCheckbox('hide', (!$object->link) , 'Сворачивать') !!} --}}

                @include('admin.includes.input', ['label' => 'Рейтинг (для сортировки):', 'name' => 'rating', 'value' => $object->rating ?? ''])
               
                @php $gallery = $object->id ? App\Models\Gallery::getGallery($item_type , $object->id) : null; @endphp
            
                {!!  \App\Helpers\GenerateForm::makeGallery('Галерея (600X600)' , 'graduate_images', $gallery , '') !!}
                
                <x-Admin.Accordion title="Русская версия">
                    @include('admin.includes.input', ['label' => 'Название:', 'name' => 'name', 'value' => $object->name ?? ''])
                    @include('admin.includes.textbox', ['label' => 'Текст:', 'name' => 'text', 'value' => $object->text ?? ''])
                    @include('admin.includes.textarea', ['label' => 'Текст 2:', 'name' => 'link', 'value' => $object->link ?? ''])
                </x-Admin.Accordion>
                <x-Admin.Accordion title="Английская версия">
                    @include('admin.includes.input', ['label' => 'Название:', 'name' => 'name_en', 'value' => $object->name_en ?? ''])
                    @include('admin.includes.textbox', ['label' => 'Текст:', 'name' => 'text_en', 'value' => $object->text_en ?? ''])
                </x-Admin.Accordion>

                @include('admin.includes.errors')
                @include('admin.includes.submit')
            </form>
        </div>


@endsection