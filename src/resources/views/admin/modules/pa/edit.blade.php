<style>
    .field {
        display: flex;
        justify-content: space-between;
        margin: 20px 0;

        .input_block:not(:first-child) {
            margin-top: unset;
        }
    }

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

<style>
    .file-loader-wrapper {
        display: flex;
        width: fit-content;
        flex-direction: column;
        row-gap: 10px;
    }

    .file-loader__button {
        height: 0;
        width: 0;
        padding: 0;
        border: 0 !important;
    }

    .Documents-btn {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        width: fit-content;
        height: 45px;
        border: none;
        padding: 0px 15px;
        border-radius: 5px;
        background-color: rgb(49, 49, 83);
        gap: 10px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .folderContainer {
        width: 40px;
        height: fit-content;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-end;
        position: relative;
    }

    .fileBack {
        z-index: 1;
        width: 80%;
        height: auto;
    }

    .filePage {
        width: 50%;
        height: auto;
        position: absolute;
        z-index: 2;
        transition: all 0.3s ease-out;
    }

    .fileFront {
        width: 85%;
        height: auto;
        position: absolute;
        z-index: 3;
        opacity: 0.95;
        transform-origin: bottom;
        transition: all 0.3s ease-out;
    }

    .text {
        color: white;
        font-size: 14px;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .Documents-btn:hover .filePage {
        transform: translateY(-5px);
    }

    .Documents-btn:hover {
        background-color: rgb(58, 58, 94);
    }

    .Documents-btn:active {
        transform: scale(0.95);
    }

    .Documents-btn:hover .fileFront {
        transform: rotateX(30deg);
    }

    button.file__delete,
    button.file__edit {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 5px;
        border: 0px solid transparent;
        background-color: rgba(100, 77, 237, 0.08);
        border-radius: 1.25em;
        transition: all 0.2s linear;
    }

    button.file__edit {
        svg {
            width: 25px;
            height: 25px
        }
    }

    button.file__delete:hover,
    button.file__edit:hover {
        box-shadow: 3.4px 2.5px 4.9px rgba(0, 0, 0, 0.025),
            8.6px 6.3px 12.4px rgba(0, 0, 0, 0.035),
            17.5px 12.8px 25.3px rgba(0, 0, 0, 0.045),
            36.1px 26.3px 52.2px rgba(0, 0, 0, 0.055),
            99px 72px 143px rgba(0, 0, 0, 0.08);
    }

    .files {
        display: flex;
        flex-direction: column;
        row-gap: 15px;

        .file {
            display: flex;
            align-items: center;
            column-gap: 20px;

            .file__name {
                max-width: 80%;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: clip;
            }
        }
    }

    .file__action {
        display: flex;
        position: relative;
        column-gap: 5px;

        .comment-popup {
            display: none;
            position: absolute;
            height: 100px;
            width: 250px;
            top: 120%;
            left: 0;
            z-index: 100;

            textarea {
                width: 100%;
                height: 100%;
                font-size: 1.2em;
                padding-right: 40px;
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

            <button data-id="{{ $object->id }}" class="getZipAchive">Сформировать архив</button>

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
                        <input type="file" id="acount_icon" class="user_icon" name="icon"
                            style=" height: 0;
                                width: 0;
                                padding: 0;
                                border: 0 !important;">
                        <img src="/storage/{{ $object->icon }}"
                            style="width: 100px; height: 100px; border-radius: 50%; cursor: pointer; object-fit: cover;"
                            alt="Иконка">
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
                        <div class="column-item" style="width: inherit !important; margin-right: unset">
                            @include('admin.includes.input', [
                                'label' => 'Отчество:',
                                'name' => 'secondName',
                                'value' => $object->secondName ?? '',
                            ])
                        </div>
                    </div>
                </div>
                @php
                    for ($i = 1970; $i < date('Y') + 50; $i++) {
                        $years[] = (object) ['id' => $i, 'name' => $i];
                    }
                @endphp
                <div class="column-items column-items2" style="padding-top: 20px">
                    <div class="column-item">
                        @include('admin.includes.select', [
                            'label' => 'Год поступления:',
                            'name' => 'admission_year',
                            'value' => $object->admission_year ?? '',
                            'select' => $years,
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
                                'placeholder' => 'дд.мм.гггг',
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

                <fieldset class="documents">
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

                    <div class="field" style="{{ $object->acountType->id == 1 ? 'display:none' : '' }}">
                        <x-input-file :files="$object->certainDocument('Диплом', $object->id)" title="Диплом" name="diploma" path="/storage/pa/" field="path"
                            page="Персональные данные" document="Диплом" />
                        @include('admin.includes.textarea', [
                            'label' => 'Комментарий:',
                            'name' => 'diplom1_comment',
                            'value' =>
                                $object->certainDocument('Диплом', $object->id, 1)->count() > 0
                                    ? $object->certainDocument('Диплом', $object->id, 1)[0]->comment
                                    : '',
                        ])
                    </div>

                    <div class="field" style="{{ $object->acountType->id == 1 ? 'display:none' : '' }}">
                        <x-input-file :files="$object->certainDocument('Реферат', $object->id)" title="Реферат" name="report" path="/storage/pa/" field="path"
                            page="Персональные данные" document="Реферат" isMultiple=true />
                        @include('admin.includes.textarea', [
                            'label' => 'Комментарий:',
                            'name' => 'report1_comment',
                            'value' =>
                                $object->certainDocument('Реферат', $object->id, 1)->count() > 0
                                    ? $object->certainDocument('Реферат', $object->id, 1)[0]->comment
                                    : '',
                        ])
                    </div>
                </fieldset>

                <div class="works" style="{{ $object->acountType->id == 2 ? 'display:none' : '' }}">
                    <fieldset class="work">
                        <legend style="display: flex; column-gap: 20px; cursor: pointer">Диссертационная работа</legend>
                        <div class="column-items column-items2">
                            <div class="column-item">
                                @include('admin.includes.input', [
                                    'label' => 'Тема диссертационной работы:',
                                    'name' => 'topic',
                                    'value' => $object->works[0]->topic ?? '',
                                ])
                            </div>
                            <div class="column-item">
                                @include('admin.includes.input', [
                                    'label' => 'Год обучения',
                                    'name' => 'year',
                                    'value' => $object->works[0]->year ?? '',
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
                                        'value' => $object->works[0]->scientific_head ?? '',
                                    ])
                                </div>
                                <div class="column-item">
                                    @include('admin.includes.input', [
                                        'label' => 'Должность',
                                        'name' => 'post',
                                        'value' => $object->works[0]->post ?? '',
                                    ])
                                </div>
                            </div>
                            <div class="column-item">
                                @include('admin.includes.input', [
                                    'label' => 'Научная степень',
                                    'name' => 'scientific_degree',
                                    'value' => $object->works[0]->scientific_degree ?? '',
                                ])
                            </div>
                        </fieldset>
                    </fieldset>
                </div>
                <fieldset class="documents-2" style="{{ $object->acountType->id == 2 ? 'display:none' : '' }}">
                    <legend>Документы</legend>
                    <div class="field">
                        <x-input-file :files="$object->certainDocument('Реферат', $object->id)" title="Реферат" name="workReport" path="/storage/pa/" field="path"
                            page="Персональные данные" document="Реферат" isMultiple=true />
                        @include('admin.includes.textarea', [
                            'label' => 'Комментарий:',
                            'name' => 'report1_comment',
                            'value' =>
                                $object->certainDocument('Реферат', $object->id, 1)->count() > 0
                                    ? $object->certainDocument('Реферат', $object->id, 1)[0]->comment
                                    : '',
                        ])
                    </div>

                    <div class="field">
                        <x-input-file :files="$object->certainDocument(
                            'Индивидуальный план научной деятельности по годам/семестрам',
                            $object->id,
                        )"
                            title="Индивидуальный план<br> научной деятельности<br> по годам/семестрам"
                            name="individualPlan" path="/storage/pa/" field="path" page="Персональные данные"
                            document="Индивидуальный план научной деятельности по годам/семестрам" isMultiple=true />
                        @include('admin.includes.textarea', [
                            'label' => 'Комментарий:',
                            'name' => 'individual_plan_comment',
                            'value' =>
                                $object->certainDocument(
                                        'Индивидуальный план научной деятельности по годам/семестрам',
                                        $object->id,
                                        1)->count() > 0
                                    ? $object->certainDocument(
                                        'Индивидуальный план научной деятельности по годам/семестрам',
                                        $object->id,
                                        1)[0]->comment
                                    : '',
                        ])
                    </div>

                    <div class="field">
                        <x-input-file :files="$object->certainDocument('План научной деятельности по годам', $object->id)" title="План научной деятельности<br> по годам" name="yearPlan"
                            path="/storage/pa/" field="path" page="Персональные данные"
                            document="План научной деятельности по годам" />
                        @include('admin.includes.textarea', [
                            'label' => 'Комментарий:',
                            'name' => 'scientific_plan_comment',
                            'value' =>
                                $object->certainDocument('План научной деятельности по годам', $object->id, 1)->count() > 0
                                    ? $object->certainDocument(
                                        'План научной деятельности по годам',
                                        $object->id,
                                        1)[0]->comment
                                    : '',
                        ])
                    </div>

                    <div class="field">
                        <x-input-file :files="$object->certainDocument('Отзыв научного руководителя', $object->id)" title="Отзыв научного<br> руководителя" name="review"
                            path="/storage/pa/" field="path" page="Персональные данные"
                            document="Отзыв научного руководителя" />
                        @include('admin.includes.textarea', [
                            'label' => 'Комментарий:',
                            'name' => 'review_comment',
                            'value' =>
                                $object->certainDocument('Отзыв научного руководителя', $object->id, 1)->count() >
                                0
                                    ? $object->certainDocument('Отзыв научного руководителя', $object->id, 1)[0]->comment
                                    : '',
                        ])
                    </div>


                    <div class="field">
                        <x-input-file :files="$object->certainDocument('Выписка из протокола семинара', $object->id)" title="Выписка из протокола<br> семинара" name="extract"
                            path="/storage/pa/" field="path" page="Персональные данные"
                            document="Выписка из протокола семинара" />
                        @include('admin.includes.textarea', [
                            'label' => 'Комментарий:',
                            'name' => 'vipiska_comment',
                            'value' =>
                                $object->certainDocument('Выписка из протокола семинара', $object->id, 1)->count() > 0
                                    ? $object->certainDocument('Выписка из протокола семинара', $object->id, 1)[0]->comment
                                    : '',
                        ])
                    </div>

                    <div class="field">
                        <x-input-file :files="$object->certainDocument('Протокол отчета на Ученом совете', $object->id)" title="Протокол отчета<br> на Ученом совете" name="protocol"
                            path="/storage/pa/" field="path" page="Персональные данные"
                            document="Протокол отчета на Ученом совете" />
                        @include('admin.includes.textarea', [
                            'label' => 'Комментарий:',
                            'name' => 'protokol_comment',
                            'value' =>
                                $object->certainDocument('Протокол отчета на Ученом совете', $object->id, 1)->count() > 0
                                    ? $object->certainDocument(
                                        'Протокол отчета на Ученом совете',
                                        $object->id,
                                        1)[0]->comment
                                    : '',
                        ])
                    </div>
                </fieldset>
            </fieldset>
            <fieldset class="achievments">
                <legend>Индивидуальные достижения</legend>
                <fieldset>
                    <legend>Публикации</legend>

                    <div class="field" style="{{ $object->acountType->id == 2 ? 'display:none' : '' }}">
                        <x-input-file :files="$object->certainDocument('Материалы конференций', $object->id)" title="Материалы конференций" name="materials"
                            path="/storage/pa/" field="path" page="Индивидуальные достижения"
                            document="Материалы конференций" />
                        @include('admin.includes.textarea', [
                            'label' => 'Комментарий:',
                            'name' => 'materials_comment',
                            'value' =>
                                $object->certainComment('Материалы конференций', $object->id, 2)->count() > 0
                                    ? $object->certainComment('Материалы конференций', $object->id, 2)[0]->comment
                                    : '',
                        ])
                    </div>

                    <div class="field" style="{{ $object->acountType->id == 2 ? 'display:none' : '' }}">
                        <x-input-file :files="$object->certainDocument('Тезисы докладов', $object->id)" title="Тезисы докладов" name="thesis" path="/storage/pa/"
                            field="path" page="Индивидуальные достижения" document="Тезисы докладов" />
                        @include('admin.includes.textarea', [
                            'label' => 'Комментарий:',
                            'name' => 'thesis_comment',
                            'value' =>
                                $object->certainComment('Тезисы докладов', $object->id, 2)->count() > 0
                                    ? $object->certainComment('Тезисы докладов', $object->id, 2)[0]->comment
                                    : '',
                        ])
                    </div>

                    <div class="field" style="{{ $object->acountType->id == 2 ? 'display:none' : '' }}">
                        <x-input-file :files="$object->certainDocument('Статьи', $object->id)" title="Статьи" name="article" path="/storage/pa/"
                            field="path" page="Индивидуальные достижения" document="Статьи" />
                        @include('admin.includes.textarea', [
                            'label' => 'Комментарий:',
                            'name' => 'article_comment',
                            'value' =>
                                $object->certainComment('Статьи', $object->id, 2)->count() > 0
                                    ? $object->certainComment('Статьи', $object->id, 2)[0]->comment
                                    : '',
                        ])
                    </div>

                    <div class="field" style="{{ $object->acountType->id == 2 ? 'display:none' : '' }}">
                        <x-input-file :files="$object->certainDocument('РИД', $object->id)" title="РИД" name="rid" path="/storage/pa/"
                            field="path" page="Индивидуальные достижения" document="РИД" />
                        @include('admin.includes.textarea', [
                            'label' => 'Комментарий:',
                            'name' => 'rid_comment',
                            'value' =>
                                $object->certainComment('РИД', $object->id, 2)->count() > 0
                                    ? $object->certainComment('РИД', $object->id, 2)[0]->comment
                                    : '',
                        ])
                    </div>

                    <div class="field">
                        <x-input-file :files="$object->certainDocument('Другое', $object->id)" title="Другое" name="other" path="/storage/pa/"
                            field="path" page="Индивидуальные достижения" document="Другое" />
                        @include('admin.includes.textarea', [
                            'label' => 'Комментарий:',
                            'name' => 'other_comment',
                            'value' =>
                                $object->certainDocument('Другое', $object->id, 2)->count() > 0
                                    ? $object->certainDocument('Другое', $object->id, 2)[0]->comment
                                    : '',
                        ])
                    </div>

                    <div class="field" style="{{ $object->acountType->id == 2 ? 'display:none' : '' }}">
                        <x-input-file :files="$object->certainDocument('Отчет аспиранта', $object->id)" title="Отчет аспиранта" name="aspirantReport"
                            path="/storage/pa/" field="path" page="Индивидуальные достижения"
                            document="Отчет аспиранта" />
                        @include('admin.includes.textarea', [
                            'label' => 'Комментарий:',
                            'name' => 'aspirant_report_comment',
                            'value' =>
                                $object->certainComment('Отчет аспиранта', $object->id, 2)->count() > 0
                                    ? $object->certainComment('Отчет аспиранта', $object->id, 2)[0]->comment
                                    : '',
                        ])
                    </div>

                    <div class="field" style="{{ $object->acountType->id == 1 ? 'display:none' : '' }}">
                        <x-input-file :files="$object->certainDocument('Реферат', $object->id)" title="Реферат" name="report" path="/storage/pa/"
                            field="path" page="Индивидуальные достижения" document="Реферат" />
                        @include('admin.includes.textarea', [
                            'label' => 'Комментарий:',
                            'name' => 'report_comment',
                            'value' =>
                                $object->certainComment('Реферат', $object->id, 2)->count() > 0
                                    ? $object->certainComment('Реферат', $object->id, 2)[0]->comment
                                    : '',
                        ])
                    </div>

                    <div class="field" style="{{ $object->acountType->id == 1 ? 'display:none' : '' }}">
                        <x-input-file :files="$object->certainDocument('Диплом', $object->id)" title="Диплом" name="diploma" path="/storage/pa/"
                            field="path" page="Индивидуальные достижения" document="Диплом" />
                        @include('admin.includes.textarea', [
                            'label' => 'Комментарий:',
                            'name' => 'diploma_comment',
                            'value' =>
                                $object->certainComment('Диплом', $object->id, 2)->count() > 0
                                    ? $object->certainComment('Диплом', $object->id, 2)[0]->comment
                                    : '',
                        ])
                    </div>
                </fieldset>
            </fieldset>

            <fieldset class="exams" style="{{ $object->acountType->id == 1 ? 'display:none' : '' }}">
                <legend>Экзаменационная ведомость</legend>
                <div class="field">
                    <x-input-file :files="$object->certainDocument('Философия', $object->id)" title="Философия" name="philosophy" path="/storage/pa/"
                        field="path" page="Экзаменационная ведомость" document="Философия" />
                    @include('admin.includes.textarea', [
                        'label' => 'Комментарий:',
                        'name' => 'philosophy_comment',
                        'value' =>
                            $object->certainComment('Философия', $object->id, 3)->count() > 0
                                ? $object->certainComment('Философия', $object->id, 3)[0]->comment
                                : '',
                    ])
                </div>

                <div class="field">
                    <x-input-file :files="$object->certainDocument('Английский язык', $object->id)" title="Английский язык" name="english" path="/storage/pa/"
                        field="path" page="Экзаменационная ведомость" document="Английский язык" />
                    @include('admin.includes.textarea', [
                        'label' => 'Комментарий:',
                        'name' => 'english_comment',
                        'value' =>
                            $object->certainComment('Английский язык', $object->id, 3)->count() > 0
                                ? $object->certainComment('Английский язык', $object->id, 3)[0]->comment
                                : '',
                    ])
                </div>

                <div class="field">
                    <x-input-file :files="$object->certainDocument('Специальность', $object->id)" title="Специальность" name="specialtyDoc" path="/storage/pa/"
                        field="path" page="Экзаменационная ведомость" document="Специальность" />
                    @include('admin.includes.textarea', [
                        'label' => 'Комментарий:',
                        'name' => 'specialty_comment',
                        'value' =>
                            $object->certainComment('Специальность', $object->id, 3)->count() > 0
                                ? $object->certainComment('Специальность', $object->id, 3)[0]->comment
                                : '',
                    ])
                </div>
            </fieldset>

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
