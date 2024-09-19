@extends('admin.app')
@section('content')

        @include('admin.includes.h1')

        <div class="admin_edit_block">
            @include('admin.includes.back')

            <form  method="post" enctype="multipart/form-data" class="admin_edit-form">
                @csrf

                {!! \App\Helpers\GenerateForm::makeCheckbox('hide', (!$object->hide) , 'Показывать') !!}
                {{-- {!! \App\Helpers\GenerateForm::makeCheckbox('main_page_hide', (!$object->main_page_hide) , 'Показывать новость в баннере') !!} --}}

                @include('admin.includes.input', ['label' => 'Заголовок', 'name' => 'name', 'value' => $object->name ?? '', 'required' => 'required'])
               
                @include('admin.includes.textbox', ['label' => 'Текст:', 'name' => 'text', 'value' => $object->text ?? ''])

                @include('admin.includes.input', ['label' => 'Cсылка (автоматически):', 'name' => 'link', 'value' => $object->link ?? ''])

                @include('admin.includes.input', ['label' => 'Рейтинг (для сортировки):', 'name' => 'rating', 'value' => $object->rating ?? ''])

                <x-Admin.Accordion title="Английская версия">
                    @include('admin.includes.input', ['label' => 'Название:', 'name' => 'name_en', 'value' => $object->name_en ?? ''])
                    @include('admin.includes.textbox', ['label' => 'Текст:', 'name' => 'text_en', 'value' => $object->text_en ?? ''])
                </x-Admin.Accordion>                

                @include('admin.includes.submit')
            </form>
        </div>

@endsection
