@extends('admin.app')
@section('content')
    <h1>Настройки</h1>

    <div class='admin_edit_block'>

        <form method="post" class="admin_edit-form" enctype="multipart/form-data">
            @csrf

            @include('admin.includes.input', ['label' => 'Телефон:', 'name' => 'phone', 'value' => $object->phone ?? ''])
            @include('admin.includes.input', ['label' => 'Email:', 'name' => 'email', 'value' => $object->email ?? ''])

            @include('admin.includes.input', ['label' => 'метео РФ:', 'name' => 'link1', 'value' => $object->link1 ?? ''])
            @include('admin.includes.input', ['label' => 'ВК:', 'name' => 'link2', 'value' => $object->link2 ?? ''])




            <fieldset>
                <legend>Информация на главной</legend>
                @include('admin.includes.input', ['label' => 'Заголовок', 'name' => 'main_info_title', 'value' => $object->main_info_title ?? ''])
                @include('admin.includes.input', ['label' => 'Цитата', 'name' => 'main_info_quote', 'value' => $object->main_info_quote ?? ''])
                {!! \App\Helpers\GenerateForm::makeTextbox('Текст' , 'main_info_text' ,  $object->main_info_text ?? '' ) !!}



                <x-Admin.Accordion title="Английская версия">

                    @include('admin.includes.input', ['label' => 'Заголовок', 'name' => 'main_info_title_en', 'value' => $object->main_info_title_en ?? ''])
                    @include('admin.includes.input', ['label' => 'Цитата', 'name' => 'main_info_quote_en', 'value' => $object->main_info_quote_en ?? ''])
                    {!! \App\Helpers\GenerateForm::makeTextbox('Текст' , 'main_info_text_en' ,  $object->main_info_text_en ?? '' ) !!}
                </x-Admin.Accordion> 

             </fieldset>


            

            <fieldset>
                <legend>Информация на странице Контакты</legend>

                @include('admin.includes.input', ['label' => 'Телефон приёмной директора:', 'name' => 'director_reception_phone', 'value' => $object->director_reception_phone ?? ''])
                @include('admin.includes.input', ['label' => 'Адрес электронной почты приёмной директора:', 'name' => 'director_reception_email', 'value' => $object->director_reception_email ?? ''])
                @include('admin.includes.input', ['label' => 'Наши координаты:', 'name' => 'contact_page_address', 'value' => $object->contact_page_address ?? ''])
                @include('admin.includes.input', ['label' => 'Наши координаты(англ):', 'name' => 'contact_page_address_en', 'value' => $object->contact_page_address_en ?? ''])

            </fieldset>
{{--            @include('admin.includes.input', ['label' => 'Текст в футере:', 'name' => 'footer_text', 'value' => $object->footer_text ?? ''])--}}


            @include('admin.includes.submit')

        </form>
    </div>
@endsection
