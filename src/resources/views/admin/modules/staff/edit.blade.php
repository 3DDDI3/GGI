@extends('admin.app')
@section('content')

        @include('admin.includes.h1')


        <div class="admin_edit_block">

            @include('admin.includes.back')

            <form  method="post" enctype="multipart/form-data" class="admin_edit-form">
                @csrf


                @include('admin.includes.input', ['label' => 'Название:', 'name' => 'name', 'value' => $object->name ?? '', 'required' => 'required'])
                @include('admin.includes.input', ['label' => 'Должность:', 'name' => 'position', 'value' => $object->position ?? ''])
                @include('admin.includes.input', ['label' => 'Степень:', 'name' => 'degree', 'value' => $object->degree ?? ''])
                @include('admin.includes.input', ['label' => 'Телефоны:', 'name' => 'phones', 'value' => $object->phone ?? ''])
                @include('admin.includes.input', ['label' => 'Email:', 'name' => 'email', 'value' => $object->email ?? ''])

                {!! \App\Helpers\GenerateForm::makeImage('Изображение', 'image' , $object , '/storage/'.$object->image) !!}
                {!! \App\Helpers\GenerateForm::makeTextbox('Описание' , 'description' ,  $object->description ?? '' ) !!}

                @include('admin.includes.select', [
                    'label'=>'Лаборатория:',
                    'name'=>'laboratories_id',
                    'value'=> $object->laboratories_id ?? '',
                    'select'=> \App\Models\Laboratories::getList()
                ])
                @include('admin.includes.select', [
                    'label'=>'Подразделение:',
                    'name'=>'subdivisions_id',
                    'value'=> $object->subdivisions_id ?? '',
                    'select'=> \App\Models\Subdivisions::getList()
                ])

                <x-Admin.Accordion title="Английская версия">
                    @include('admin.includes.input', ['label' => 'Название:', 'name' => 'name_en', 'value' => $object->name_en ?? ''])
                    @include('admin.includes.input', ['label' => 'Должность:', 'name' => 'position_en', 'value' => $object->position_en ?? ''])
                    @include('admin.includes.input', ['label' => 'Степень:', 'name' => 'degree_en', 'value' => $object->degree_en ?? ''])
                </x-Admin.Accordion>            

                @include('admin.includes.errors')
                @include('admin.includes.submit')
            </form>
        </div>


@endsection