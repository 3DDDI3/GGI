@extends('admin.app')
@section('content')

        @include('admin.includes.h1')

        <div class="admin_edit_block">
            @include('admin.includes.back')

            <form  method="post" enctype="multipart/form-data" class="admin_edit-form">
                @csrf

                {!! \App\Helpers\GenerateForm::makeCheckbox('hide', (!$object->hide) , 'Показывать') !!}

                @include('admin.includes.select', [
                    'label'=>'Родительский раздел:',
                    'name'=>'parent_id',
                    'value'=> $object->{$object->type}->parent_id ?? '',
                    'select'=> \App\Models\Content::where('type', 'departments')->where('id', '<>', $object->id)->get()
                ])

                @include('admin.includes.textarea', ['label' => 'Имя', 'name' => 'name', 'value' => $object->name ?? '', 'required' => 'required'])
               
                {!! \App\Helpers\GenerateForm::makeTextbox('Текст' , 'text' ,  $object->text ?? '' ) !!}

                <div class="input_block selectForm">
                    <span>Сотрудники</span>
                    @foreach ($staff as $item)
                        {!! \App\Helpers\GenerateForm::makeCheckbox('idStaff'.$item->id, ($item->check) , ($item->name)) !!}
                    @endforeach
                </div>

                

                @include('admin.includes.input', ['label' => 'Cсылка (автоматически):', 'name' => 'url', 'value' => $object->link ?? ''])
                @include('admin.includes.input', ['label' => 'Рейтинг (для сортировки):', 'name' => 'rating', 'value' => $object->rating ?? ''])

                <x-Admin.Accordion title="Английская версия">
                    @include('admin.includes.input', ['label' => 'Название:', 'name' => 'name_en', 'value' => $object->name_en ?? ''])
                    {!! \App\Helpers\GenerateForm::makeTextbox('Текст' , 'text_en' ,  $object->text_en ?? '' ) !!}
                </x-Admin.Accordion>

                @include('admin.includes.submit')
            </form>
        </div>

@endsection
