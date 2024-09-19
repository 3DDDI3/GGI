@extends('admin.app')
@section('content')

        @include('admin.includes.h1')

        <div class="admin_edit_block">

            <div class="admin_edit-links">
                <a href="{{route('admin.'.$PATH.'.index')}}">Назад к списку</a>
            </div>

            <form  method="post" enctype="multipart/form-data" class="admin_edit-form">

                @csrf

                {!! \App\Helpers\GenerateForm::makeCheckbox('header_hide', (!$object->header_hide) , 'Показывать в выпадающем меню') !!}
                {!! \App\Helpers\GenerateForm::makeCheckbox('footer_hide', (!$object->footer_hide) , 'Показывать в подвале') !!}


                @include('admin.includes.input', ['label' => 'Заголовок', 'name' => 'name', 'value' => $object->name ?? '', 'required' => 'required'])

                {!! \App\Helpers\GenerateForm::makeImage('Баннер', 'banner' , $object , '/storage/'.$object->banner) !!}

                @switch ($object->page_code)
                    @case('istoriia')
                        @include('admin.includes.input', ['label' => 'Организационно-правовая форма', 'name' => 'text_2', 'value' => $object->text_2 ?? ''])
                        @include('admin.includes.input', ['label' => 'Полное наименование', 'name' => 'text_3', 'value' => $object->text_3 ?? ''])
                        @include('admin.includes.input', ['label' => 'Сокращенное наименование', 'name' => 'text_4', 'value' => $object->text_4 ?? ''])
                        @include('admin.includes.input', ['label' => 'Наименования на английском языке', 'name' => 'text_5', 'value' => $object->text_5 ?? ''])
                        @include('admin.includes.input', ['label' => 'Ведомственная принадлежность', 'name' => 'text_6', 'value' => $object->text_6 ?? ''])
                    @break
                    @case('struktura')
                        {!! \App\Helpers\GenerateForm::makeFile('Файл', 'file' , $object , '/storage/'.$object->file) !!}
                    @break
                @endswitch

                @switch ($object->page_code)
                    @case('istoriia')
                        @include('admin.includes.textarea', ['label' => 'Текст', 'name' => 'text', 'value' => $object->text ?? ''])
                    @break
                    @default
                        {!! \App\Helpers\GenerateForm::makeTextbox('Текст' , 'text' ,  $object->text ?? '' ) !!}
                    @break
                @endswitch

                @include('admin.includes.input', ['label' => 'Cсылка (автоматически):', 'name' => 'url', 'value' => $object->url ?? ''])

                @include('admin.includes.input', ['label' => 'Рейтинг (для сортировки):', 'name' => 'rating', 'value' => $object->rating ?? ''])

                <x-Admin.Accordion title="Прикрепленные документы">
                    @include('admin.includes.filebox', ['name' => 'files_doc', 'item_type' => 'pages', 'object' => $object])
                </x-Admin.Accordion>

                <x-Admin.Accordion title="Английская версия">
                        @switch ($object->page_code)
                            @case('istoriia')
                                @include('admin.includes.input', ['label' => 'Организационно-правовая форма', 'name' => 'text_2_en', 'value' => $object->text_2_en ?? ''])
                                @include('admin.includes.input', ['label' => 'Полное наименование', 'name' => 'text_3_en', 'value' => $object->text_3_en ?? ''])
                                @include('admin.includes.input', ['label' => 'Сокращенное наименование', 'name' => 'text_4_en', 'value' => $object->text_4_en ?? ''])
                                @include('admin.includes.input', ['label' => 'Наименования на английском языке', 'name' => 'text_5_en', 'value' => $object->text_5_en ?? ''])
                                @include('admin.includes.input', ['label' => 'Ведомственная принадлежность', 'name' => 'text_6_en', 'value' => $object->text_6_en ?? ''])
                            @break
                        @endswitch

                    @switch ($object->page_code)
                        @case('istoriia')
                            @include('admin.includes.textarea', ['label' => 'Текст', 'name' => 'text_en', 'value' => $object->text_en ?? ''])
                        @default
                            {!! \App\Helpers\GenerateForm::makeTextbox('Текст' , 'text_en' ,  $object->text_en ?? '' ) !!}
                        @break
                    @endswitch
                </x-Admin.Accordion>

                @include('admin.includes.submit')
            </form>

        </div>


@endsection
