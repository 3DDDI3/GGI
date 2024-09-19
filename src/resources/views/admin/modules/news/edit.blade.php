@extends('admin.app')
@section('content')

        @include('admin.includes.h1')

        <div class="admin_edit_block">
            @include('admin.includes.back')

            <form  method="post" enctype="multipart/form-data" class="admin_edit-form">
                @csrf

                {!! \App\Helpers\GenerateForm::makeCheckbox('hide', (!$object->hide) , 'Показывать') !!}
                {!! \App\Helpers\GenerateForm::makeCheckbox('main_page_hide', (!$object->main_page_hide) , 'Показывать в баннере') !!}
                {!! \App\Helpers\GenerateForm::makeCheckbox('arxiv', ($object->arxiv) , 'Добавить в архив') !!}

                @include('admin.includes.input', ['label' => 'Заголовок', 'name' => 'name', 'value' => $object->name ?? '', 'required' => 'required'])
                @include('admin.includes.input', ['label' => 'Подзаголовок', 'name' => 'name2', 'value' => $object->{$object->type}->name2 ?? ''])

                @include('admin.includes.input', ['type'=>'date','label' => 'Дата', 'name' => 'date', 'value' => date('Y-m-d', $object->{$object->type}->date ?? null) ?? ''])
                
                {!! \App\Helpers\GenerateForm::makeImage('Баннер (1920X867)', 'image' , $object , '/storage/'.$object->image) !!}
                
                @php $gallery = $object->{$object->type}  ? App\Models\Gallery::getGallery('news' , $object->{$object->type}->id) : null; @endphp
                {!!  \App\Helpers\GenerateForm::makeGallery('Галерея (273X203)' , 'images', $gallery , '') !!}

                @include('admin.includes.textarea', ['label' => 'Краткий текст:', 'name' => 'preview_text', 'value' => $object->{$object->type}->preview_text ?? ''])
               
                @include('admin.includes.textbox', ['label' => 'Текст:', 'name' => 'text', 'value' => $object->text ?? ''])

                @include('admin.includes.input', ['label' => 'Cсылка (автоматически):', 'name' => 'link', 'value' => $object->link ?? ''])

                @include('admin.includes.input', ['label' => 'Рейтинг (для сортировки):', 'name' => 'rating', 'value' => $object->rating ?? ''])

                <x-Admin.Accordion title="Английская версия">
                    @include('admin.includes.input', ['label' => 'Название:', 'name' => 'name_en', 'value' => $object->name_en ?? ''])
                    @include('admin.includes.input', ['label' => 'Подзаголовок', 'name' => 'name2_en', 'value' => $object->{$object->type}->name2_en ?? ''])
                    @include('admin.includes.textarea', ['label' => 'Краткий текст:', 'name' => 'preview_text_en', 'value' => $object->{$object->type}->preview_text_en ?? ''])
                    @include('admin.includes.textbox', ['label' => 'Текст:', 'name' => 'text_en', 'value' => $object->text_en ?? ''])
                </x-Admin.Accordion>

                @include('admin.includes.submit')
            </form>
        </div>

@endsection
