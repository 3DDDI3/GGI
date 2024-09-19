@extends('admin.app')
@section('content')

        @include('admin.includes.h1')

        <div class="admin_edit_block">
            @include('admin.includes.back')

            <form  method="post" enctype="multipart/form-data" class="admin_edit-form">
                @csrf

                {!! \App\Helpers\GenerateForm::makeCheckbox('hide', (!$object->hide) , 'Показывать') !!}

                @include('admin.includes.textarea', ['label' => 'Имя', 'name' => 'name', 'value' => $object->name ?? '', 'required' => 'required'])
               
                @include('admin.includes.input', ['label' => 'Должность', 'name' => 'position', 'value' => $object->{$object->type}->position ?? ''])

                @include('admin.includes.input', ['label' => 'Степень', 'name' => 'degree', 'value' => $object->{$object->type}->degree ?? ''])

                @include('admin.includes.input', ['label' => 'Телефон', 'name' => 'phones', 'value' => $object->{$object->type}->phones ?? ''])

                @include('admin.includes.input', ['label' => 'Телефон приемной', 'name' => 'phones_adm', 'value' => $object->{$object->type}->phones_adm ?? ''])

                @include('admin.includes.input', ['label' => 'Телефон Факс', 'name' => 'phones_fax', 'value' => $object->{$object->type}->phones_fax ?? ''])

                @include('admin.includes.input', ['label' => 'Email', 'name' => 'email', 'value' => $object->{$object->type}->email ?? ''])

                @include('admin.includes.input', ['label' => 'Рейтинг (для сортировки):', 'name' => 'rating', 'value' => $object->rating ?? ''])

                <x-Admin.Accordion title="Английская версия">
                    @include('admin.includes.input', ['label' => 'Название:', 'name' => 'name_en', 'value' => $object->name_en ?? ''])
                    @include('admin.includes.input', ['label' => 'Должность', 'name' => 'position_en', 'value' => $object->{$object->type}->position_en ?? ''])
                    @include('admin.includes.input', ['label' => 'Степень', 'name' => 'degree_en', 'value' => $object->{$object->type}->degree_en ?? ''])
                </x-Admin.Accordion>

                @include('admin.includes.submit')
            </form>
        </div>

@endsection
