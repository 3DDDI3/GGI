@extends('admin.app')
@section('content')

        @include('admin.includes.h1')

        <div class="admin_edit_block">
            @include('admin.includes.back')

            <form  method="post" enctype="multipart/form-data" class="admin_edit-form">
                @csrf

                {!! \App\Helpers\GenerateForm::makeCheckbox('hide', (!$object->hide) , 'Показывать') !!}

                @include('admin.includes.textarea', ['label' => 'Заголовок', 'name' => 'name', 'value' => $object->name ?? '', 'required' => 'required'])
                
                
                @php $gallery = $object->{$object->type}  ? App\Models\Gallery::getGallery('courses' , $object->{$object->type}->id) : null; @endphp
            
                {!!  \App\Helpers\GenerateForm::makeGallery('Галерея (638X457)' , 'images', $gallery , '') !!}
               
                @include('admin.includes.textbox', ['label' => 'Текст:', 'name' => 'text', 'value' => $object->text ?? ''])

                @include('admin.includes.textbox', ['label' => 'Текст 2:', 'name' => 'text_2', 'value' => $object->{$object->type}->text_2 ?? ''])

                {{-- @include('admin.includes.textbox', ['label' => 'Текст 3:', 'name' => 'text_3', 'value' => $object->{$object->type}->text_3 ?? ''])

                @include('admin.includes.textbox', ['label' => 'Текст 4:', 'name' => 'text_4', 'value' => $object->{$object->type}->text_4 ?? ''])

                @include('admin.includes.textbox', ['label' => 'Текст 5:', 'name' => 'text_5', 'value' => $object->{$object->type}->text_5 ?? '']) --}}

                @include('admin.includes.input', ['label' => 'Cсылка (автоматически):', 'name' => 'link', 'value' => $object->link ?? ''])

                @include('admin.includes.input', ['label' => 'Рейтинг (для сортировки):', 'name' => 'rating', 'value' => $object->rating ?? ''])

                <x-Admin.Accordion title="Английская версия">
                    @include('admin.includes.input', ['label' => 'Название:', 'name' => 'name_en', 'value' => $object->name_en ?? ''])
                    @include('admin.includes.textbox', ['label' => 'Текст:', 'name' => 'text_en', 'value' => $object->text_en ?? ''])
                    @include('admin.includes.textbox', ['label' => 'Текст 2:', 'name' => 'text_2_en', 'value' => $object->{$object->type}->text_2_en ?? ''])
                </x-Admin.Accordion>

                @include('admin.includes.submit')
            </form>
        </div>

@endsection
