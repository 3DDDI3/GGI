<style>
    .field-wrapper {
        display: flex;
        justify-content: space-between;
        margin: 20px 0;

        .input_block {
            margin-top: unset !important;
        }

        .field {
            display: flex;
            flex-direction: column;

            max-width: 50%;

            a {
                max-width: min-content;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
        }
    }
</style>

@extends('admin.app')
@section('content')
    @include('admin.includes.h1')

    <div class="admin_edit_block">

        <div class="admin_edit-links">
            <a href="{{ route('admin.pa.index') }}">Назад к списку</a>
        </div>

        <form method="post" class="admin_edit-form" enctype="multipart/form-data">

            @csrf

            <fieldset>
                <legend>Тип пользователя</legend>

                @include('admin.includes.select', [
                    'label' => 'Тип пользователя:',
                    'name' => 'class',
                    'value' => $object->acountType->id ?? 0,
                    'select' => $select,
                ])

            </fieldset>

            <fieldset>
                <legend>Персональные данные</legend>

                <div class="column-items column-items2" style="align-items: center; column-gap: 50px">
                    <label for="acount_icon">
                        <input type="file" id="acount_icon"
                            style=" height: 0;
                                width: 0;
                                padding: 0;
                                border: 0 !important;">
                        <img src="storage/pa/{{ $object->icon }}"
                            style="width: 100px; height: 100px; border-radius: 50%; cursor: pointer" alt="Иконка">
                    </label>
                    <div style="flex-grow: 1; display: flex; flex-direction: column; row-gap: 10px;">
                        <div class="column-item" style="width: inherit !important; margin-right: unset ">
                            @include('admin.includes.input', [
                                'label' => 'Фамилия:',
                                'name' => 'lastName',
                                'value' => $object->lastName ?? '',
                            ])
                        </div>
                        <div class="column-item" style="width: inherit !important">
                            @include('admin.includes.input', [
                                'label' => 'Имя:',
                                'name' => 'firstName',
                                'value' => $object->firstName ?? '',
                            ])
                        </div>
                        <div class="column-item">
                            @include('admin.includes.input', [
                                'label' => 'Год поступления:',
                                'name' => 'admission_year',
                                'value' => $object->admission_year ?? '',
                            ])
                        </div>
                    </div>
                </div>
                <div class="column-items column-items2" style="padding-top: 20px">
                    <div class="column-item">
                        @include('admin.includes.input', [
                            'label' => 'Отчество:',
                            'name' => 'secondName',
                            'value' => $object->secondName ?? '',
                        ])
                    </div>
                    <div class="column-item">
                        @include('admin.includes.input', [
                            'label' => 'Email:',
                            'name' => 'email',
                            'value' => $object->email ?? '',
                        ])
                    </div>
                </div>

                <fieldset>
                    <legend>Основная информация</legend>
                    <div class="column-items column-items2">
                        <div class="column-item">
                            @include('admin.includes.input', [
                                'label' => 'Дата рождения:',
                                'name' => 'birthday',
                                'value' => $object->birthday->format('d.m.Y') ?? '',
                            ])
                        </div>
                        <div class="column-item">
                            @include('admin.includes.input', [
                                'label' => 'Специальность:',
                                'name' => 'specialty',
                                'value' => $object->specialty ?? '',
                            ])
                        </div>
                    </div>
                    @include('admin.includes.textarea', [
                        'label' => 'Место учебы:',
                        'name' => 'study_place',
                        'value' => $object->study_place ?? '',
                    ])
                </fieldset>

                <fieldset>
                    <legend>Документы</legend>
                    <div class="field-wrapper">
                        <div class="field">
                            {!! \App\Helpers\GenerateForm::makeFile('Паспорт', 'passport', $object, '/storage/' . $object->passport) !!}
                        </div>
                        @include('admin.includes.textarea', [
                            'label' => 'Комментарий:',
                            'name' => 'passport_comment',
                            'value' => $object->passport_comment,
                        ])
                    </div>

                    <div class="field-wrapper">
                        <div class="field">
                            {!! \App\Helpers\GenerateForm::makeFile('Снилс', 'snils', $object, '/storage/' . $object->snils) !!}
                        </div>
                        @include('admin.includes.textarea', [
                            'label' => 'Комментарий:',
                            'name' => 'snils_comment',
                            'value' => $object->snils_comment,
                        ])
                    </div>

                    <div class="field-wrapper">
                        <div class="field">
                            {!! \App\Helpers\GenerateForm::makeFile('ИНН', 'inn', $object, '/storage/' . $object->inn) !!}
                        </div>
                        @include('admin.includes.textarea', [
                            'label' => 'Комментарий:',
                            'name' => 'inn_comment',
                            'value' => $object->inn_comment,
                        ])
                    </div>

                    <div class="field">
                        <x-input-file :files="$object->certainDocument('Диплом', $object->id)" title="Диплом" name="diploma" path="/storage/pa/" field="path"
                            page="Персональные данные" document="Диплом" />
                    </div>

                    <div class="field">
                        <x-input-file :files="$object->certainDocument('Реферат', $object->id)" title="Реферат" name="report" path="/storage/pa/" field="path"
                            page="Персональные данные" document="Реферат" isMultiple=true />
                    </div>
                </fieldset>

                <div class="works">
                    <fieldset class="work">
                        <legend style="display: flex; column-gap: 20px; cursor: pointer">Диссертационная работа</legend>
                        <div class="column-items column-items2">
                            <div class="column-item">
                                @include('admin.includes.input', [
                                    'label' => 'Тема диссертационной работы:',
                                    'name' => 'topic',
                                    'value' => $work->topic ?? '',
                                ])
                            </div>
                            <div class="column-item">
                                @include('admin.includes.input', [
                                    'label' => 'Год обучения',
                                    'name' => 'year',
                                    'value' => $work->year ?? '',
                                ])
                            </div>
                        </div>
                        <fieldset>
                            <legend>Научный руководитель</legend>
                            <div class="column-items column-items2">
                                <div class="column-item">
                                    @include('admin.includes.input', [
                                        'label' => 'Ф.И.О.',
                                        'name' => 'scientific_head',
                                        'value' => $work->scientific_head ?? '',
                                    ])
                                </div>
                                <div class="column-item">
                                    @include('admin.includes.input', [
                                        'label' => 'Должность',
                                        'name' => 'post',
                                        'value' => $work->post ?? '',
                                    ])
                                </div>
                            </div>
                            <div class="column-item">
                                @include('admin.includes.input', [
                                    'label' => 'Научная степень',
                                    'name' => 'scientific_degree',
                                    'value' => $work->scientific_degree ?? '',
                                ])
                            </div>
                        </fieldset>
                    </fieldset>
                </div>
            </fieldset>
    </div>

    <fieldset>
        <legend>Документы</legend>
        <div class="field">
            <x-input-file :files="$object->certainDocument('Реферат', $object->id)" title="Реферат" name="workReport" path="/storage/pa/" field="path"
                page="Персональные данные" document="Реферат" isMultiple=true />
        </div>

        <div class="field">
            <x-input-file :files="$object->certainDocument(
                'Индивидуальный план научной деятельности по годам/семестрам',
                $object->id,
            )" title="Индивидуальный план<br> научной деятельности<br> по годам/семестрам"
                name="individualPlan" path="/storage/pa/" field="path" page="Персональные данные"
                document="Индивидуальный план научной деятельности по годам/семестрам" isMultiple=true />
        </div>

        <div class="field">
            <x-input-file :files="$object->certainDocument('План научной деятельности по годам', $object->id)" title="План научной деятельности<br> по годам" name="yearPlan"
                path="/storage/pa/" field="path" page="Персональные данные"
                document="План научной деятельности по годам" />
        </div>

        <div class="field">
            <x-input-file :files="$object->certainDocument('Отзыв научного руководителя', $object->id)" title="Отзыв научного<br> руководителя" name="review" path="/storage/pa/"
                field="path" page="Персональные данные" document="Отзыв научного руководителя" />
        </div>


        <div class="field">
            <x-input-file :files="$object->certainDocument('Выписка из протокола семинара', $object->id)" title="Выписка из протокола<br> семинара" name="extract" path="/storage/pa/"
                field="path" page="Персональные данные" document="Выписка из протокола семинара" />
        </div>

        <div class="field-wrapper">
            <div class="field">
                <x-input-file :files="$object->certainDocument('Протокол отчета на Ученом совете', $object->id)" title="Протокол отчета<br> на Ученом совете" name="protocolComment"
                    path="/storage/pa/" field="path" page="Персональные данные"
                    document="Протокол отчета на Ученом совете" />
            </div>
        </div>
    </fieldset>

    {{-- <fieldset>
                <legend>Индивидуальные достижения</legend>
                <fieldset>
                    <legend>Публикации</legend>

                    <div class="field-wrapper">
                        <div class="field">
                            {!! \App\Helpers\GenerateForm::makeFile(
                                'Материалы конференций',
                                'materials',
                                $object->certainDocument('Материалы конференций', $object->id),
                                '/storage' . $object->certainDocument('Материалы конференций', $object->id)->path,
                                field: 'path',
                            ) !!}
                        </div>
                        @include('admin.includes.textarea', [
                            'label' => 'Комментарий:',
                            'name' => 'materials_comment',
                            'value' => $object->certainDocument('Материалы конференций', $object->id)->comment,
                        ])
                    </div>

                    <div class="field-wrapper">
                        <div class="field">
                            {!! \App\Helpers\GenerateForm::makeFile(
                                'Тезисы докладов',
                                'thesis',
                                $object->certainDocument('Тезисы докладов', $object->id),
                                '/storage' . $object->certainDocument('Тезисы докладов', $object->id)->path,
                                field: 'path',
                            ) !!}
                        </div>
                        @include('admin.includes.textarea', [
                            'label' => 'Комментарий:',
                            'name' => 'thesis_comment',
                            'value' => $object->certainDocument('Тезисы докладов', $object->id)->comment,
                        ])
                    </div>

                    <div class="field-wrapper">
                        <div class="field">
                            {!! \App\Helpers\GenerateForm::makeFile(
                                'Статьи',
                                'article',
                                $object->certainDocument('Статьи', $object->id),
                                '/storage' . $object->certainDocument('Статьи', $object->id)->path,
                                field: 'path',
                            ) !!}
                        </div>
                        @include('admin.includes.textarea', [
                            'label' => 'Комментарий:',
                            'name' => 'article_comment',
                            'value' => $object->certainDocument('Статьи', $object->id)->comment,
                        ])
                    </div>

                    <div class="field-wrapper">
                        <div class="field">
                            {!! \App\Helpers\GenerateForm::makeFile(
                                'РИД',
                                'rid',
                                $object->certainDocument('РИД', $object->id),
                                '/storage' . $object->certainDocument('РИД', $object->id)->path,
                                field: 'path',
                            ) !!}
                        </div>
                        @include('admin.includes.textarea', [
                            'label' => 'Комментарий:',
                            'name' => 'rid_comment',
                            'value' => $object->certainDocument('РИД', $object->id)->comment,
                        ])
                    </div>

                    <div class="field-wrapper">
                        <div class="field">
                            {!! \App\Helpers\GenerateForm::makeFile(
                                'Другое',
                                'other',
                                $object->certainDocument('Другое', $object->id),
                                '/storage' . $object->certainDocument('Другое', $object->id)->path,
                                field: 'path',
                            ) !!}
                        </div>
                        @include('admin.includes.textarea', [
                            'label' => 'Комментарий:',
                            'name' => 'other_comment',
                            'value' => $object->certainDocument('Другое', $object->id)->comment,
                        ])
                    </div>

                    <div class="field-wrapper">
                        <div class="field">
                            {!! \App\Helpers\GenerateForm::makeFile(
                                'Отчет аспиранта',
                                'aspirantReport',
                                $object->certainDocument('Отчет аспиранта', $object->id),
                                '/storage/pa',
                                field: 'path',
                            ) !!}
                        </div>
                        @include('admin.includes.textarea', [
                            'label' => 'Комментарий:',
                            'name' => 'aspirantReport_comment',
                            'value' => $object->certainDocument('Отчет аспиранта', $object->id)->comment,
                        ])
                    </div>
                </fieldset>
            </fieldset>

            <fieldset>
                <legend>Экзаменационная ведомость</legend>
                <div class="field-wrapper">
                    <div class="field">
                        {!! \App\Helpers\GenerateForm::makeFile(
                            'Философия',
                            'philosophy',
                            $object->certainDocument('Философия', $object->id),
                            '/storage' . $object->certainDocument('Философия', $object->id)->path,
                            field: 'path',
                        ) !!}
                    </div>
                    @include('admin.includes.textarea', [
                        'label' => 'Комментарий:',
                        'name' => 'philosophy_comment',
                        'value' => $object->certainDocument('Философия', $object->id)->comment,
                    ])
                </div>

                <div class="field-wrapper">
                    <div class="field">
                        {!! \App\Helpers\GenerateForm::makeFile(
                            'Английский язык',
                            'english',
                            $object->certainDocument('Английский язык', $object->id),
                            '/storage' . $object->certainDocument('Английский язык', $object->id)->path,
                            field: 'path',
                        ) !!}
                    </div>
                    @include('admin.includes.textarea', [
                        'label' => 'Комментарий:',
                        'name' => 'english_comment',
                        'value' => $object->certainDocument('Английский язык', $object->id)->comment,
                    ])
                </div>

                <div class="field-wrapper">
                    <div class="field">
                        {!! \App\Helpers\GenerateForm::makeFile(
                            'Специальность',
                            'specialtyDoc',
                            $object->certainDocument('Специальность', $object->id),
                            '/storage' . $object->certainDocument('Специальность', $object->id)->path,
                            field: 'path',
                        ) !!}
                    </div>
                    @include('admin.includes.textarea', [
                        'label' => 'Комментарий:',
                        'name' => 'specialtyDoc_comment',
                        'value' => $object->certainDocument('Специальность', $object->id)->comment,
                    ])
                </div>
            </fieldset> --}}

    @include('admin.includes.submit')

    </form>
    </div>

    <script src="/lib/jquery.min.js"></script>
    <script>
        $(".file_delete").on("click", function(e) {
            e.stopImmediatePropagation();

            Swal.fire({
                title: 'Вы действительно хотите удалить?',
                text: 'Отменить это действие будет невозможно',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Удалить',
                cancelButtonText: 'Отмена',
            }).then((response) => {

                $.ajax({
                    type: "delete",
                    url: "/api/pa/files/delete",
                    data: {
                        id: $(this).data("id"),
                        field: $(this).parents(".field").find("input[type='file']").attr("name"),
                        path: $(this).parents(".admin_file_container").find("a").text()
                    },
                    dataType: "json",
                    success: function(response) {
                        $(this).parents(".field-wrapper").find(".input_block textarea").val("");
                        $(this).parents(".admin_file_container").remove();

                        Swal.fire({
                            icon: 'success',
                            title: 'Удалено',
                            timer: 1000,
                        });
                    }.bind(this)
                });
            });

        });
    </script>
@endsection
