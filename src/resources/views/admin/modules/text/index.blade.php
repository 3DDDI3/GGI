@extends('admin.app')
@section('content')

        @include('admin.includes.h1')

        <div class="admin_edit_block">
            @include('admin.includes.back')

            <form  method="post" enctype="multipart/form-data" class="admin_edit-form">
                @csrf

                <fieldset>
                    <legend>Секция 1</legend>
                    @include('admin.includes.input', ['label' => 'Текст 1', 'name' => 'section_1_text_1', 'value' => $object->section_1_text_1 ?? '', 'required' => 'required'])
                    @include('admin.includes.input', ['label' => 'Текст 2', 'name' => 'section_1_text_2', 'value' => $object->section_1_text_2 ?? '', 'required' => 'required'])
                    @include('admin.includes.input', ['label' => 'Текст 3', 'name' => 'section_1_text_3', 'value' => $object->section_1_text_3 ?? '', 'required' => 'required'])
                    @include('admin.includes.input', ['label' => 'Текст 4', 'name' => 'section_1_text_4', 'value' => $object->section_1_text_4 ?? '', 'required' => 'required'])
                    @include('admin.includes.textarea', ['label' => 'Текст 5', 'name' => 'section_1_text_5', 'value' => $object->section_1_text_5 ?? '', 'required' => 'required'])
                </fieldset>

                <fieldset>
                    <legend>Секция 2</legend>
                    @include('admin.includes.input', ['label' => 'Текст 1', 'name' => 'section_2_text_1', 'value' => $object->section_2_text_1 ?? '', 'required' => 'required'])
                    @include('admin.includes.input', ['label' => 'Текст 2', 'name' => 'section_2_text_2', 'value' => $object->section_2_text_2 ?? '', 'required' => 'required'])
                    @include('admin.includes.textbox', ['label' => 'Текст 3', 'name' => 'section_2_text_3', 'value' => $object->section_2_text_3 ?? '', 'required' => 'required'])
                    @include('admin.includes.textbox', ['label' => 'Текст 4', 'name' => 'section_2_text_4', 'value' => $object->section_2_text_4 ?? '', 'required' => 'required'])
                    @include('admin.includes.input', ['label' => 'Текст 5', 'name' => 'section_2_text_5', 'value' => $object->section_2_text_5 ?? '', 'required' => 'required'])
                    @include('admin.includes.input', ['label' => 'Текст 6', 'name' => 'section_2_text_6', 'value' => $object->section_2_text_6 ?? '', 'required' => 'required'])
                </fieldset>

                <fieldset>
                    <legend>Секция 3</legend>
                    @include('admin.includes.input', ['label' => 'Текст 1', 'name' => 'section_3_text_1', 'value' => $object->section_3_text_1 ?? '', 'required' => 'required'])
                </fieldset>

                <fieldset>
                    <legend>Секция 5</legend>
                    @include('admin.includes.input', ['label' => 'Текст 1', 'name' => 'section_5_text_1', 'value' => $object->section_5_text_1 ?? '', 'required' => 'required'])
                    @include('admin.includes.input', ['label' => 'Текст 2', 'name' => 'section_5_text_2', 'value' => $object->section_5_text_2 ?? '', 'required' => 'required'])
                    @include('admin.includes.input', ['label' => 'Текст 3', 'name' => 'section_5_text_3', 'value' => $object->section_5_text_3 ?? '', 'required' => 'required'])
                </fieldset>

                <fieldset>
                    <legend>Секция 6</legend>
                    @include('admin.includes.input', ['label' => 'Текст 6', 'name' => 'section_6_text_1', 'value' => $object->section_6_text_1 ?? '', 'required' => 'required'])
                </fieldset>

                @include('admin.includes.submit')
            </form>
        </div>

@endsection
