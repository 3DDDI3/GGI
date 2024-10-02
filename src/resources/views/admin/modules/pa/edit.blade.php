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

                <div class="column-items column-items2">
                    <div class="column-item">
                        @include('admin.includes.input', [
                            'label' => 'Фамилия:',
                            'name' => 'lastName',
                            'value' => $object->lastName ?? '',
                        ])
                    </div>
                    <div class="column-item">
                        @include('admin.includes.input', [
                            'label' => 'Имя:',
                            'name' => 'firstName',
                            'value' => $object->firstName ?? '',
                        ])
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
                    {!! \App\Helpers\GenerateForm::makeFile('Паспорт', 'passport', $object, '/storage/' . $object->passport) !!}
                    {!! \App\Helpers\GenerateForm::makeFile('Снилс', 'snils', $object, '/storage/' . $object->snils) !!}
                    {!! \App\Helpers\GenerateForm::makeFile('ИНН', 'inn', $object, '/storage/' . $object->inn) !!}
                    {!! \App\Helpers\GenerateForm::makeFile(
                        'Диплом',
                        'diploma',
                        $object->certainDocument('Диплом'),
                        '/storage/' . $object->certainDocument('Диплом')->path,
                    ) !!}
                    {!! \App\Helpers\GenerateForm::makeFile(
                        'Реферат',
                        'report',
                        $object->certainDocument('Реферат'),
                        '/storage/' . $object->certainDocument('Реферат')->path,
                    ) !!}
                </fieldset>

                <fieldset>
                    <legend>Добавление новой работы</legend>
                    <div class="add-new-work" style="display: flex; column-gap:10px">
                        <select name="workYear" style="cursor: pointer">
                            @for ($i = 1970; $i < date('Y') + 50; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <button class="add-new-work__button" class="button">Добавить работу</button>
                    </div>
                </fieldset>

                <div class="works">
                    @foreach ($object->works()->orderBy('year', 'desc')->get() as $work)
                        <fieldset class="work">
                            <legend style="display: flex; column-gap: 20px; cursor: pointer">Работы {{ $work->year }} года
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_85_80)">
                                        <path
                                            d="M7.78671 12.1108C7.60462 12.1 7.43154 12.017 7.29731 11.8761L1.18945 5.43842C1.11393 5.35843 1.05293 5.26224 1.00997 5.15533C0.966998 5.04843 0.942897 4.93291 0.93903 4.81537C0.935163 4.69783 0.951603 4.58057 0.987426 4.47029C1.02325 4.36001 1.07775 4.25887 1.1478 4.17263C1.21786 4.0864 1.30211 4.01677 1.39574 3.96772C1.48937 3.91866 1.59054 3.89114 1.69348 3.88674C1.79642 3.88233 1.89911 3.90112 1.99569 3.94203C2.09227 3.98294 2.18085 4.04517 2.25637 4.12517L7.83077 9.99841L13.4052 4.12517C13.4807 4.04517 13.5693 3.98294 13.6658 3.94203C13.7624 3.90112 13.8651 3.88233 13.968 3.88674C14.071 3.89115 14.1722 3.91866 14.2658 3.96772C14.3594 4.01677 14.4437 4.0864 14.5137 4.17263C14.5838 4.25887 14.6383 4.36001 14.6741 4.47029C14.7099 4.58058 14.7264 4.69783 14.7225 4.81537C14.7186 4.93291 14.6945 5.04843 14.6516 5.15533C14.6086 5.26224 14.5476 5.35843 14.4721 5.43842L8.36422 11.8761C8.28672 11.9575 8.19564 12.0203 8.09642 12.0606C7.99719 12.1009 7.89185 12.118 7.78671 12.1108Z"
                                            fill="#494949" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_85_80">
                                            <rect width="16" height="16" fill="white"
                                                transform="matrix(-4.37114e-08 1 1 4.37114e-08 0 0)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </legend>
                            <div style="display: none" class="work__wrapper">
                                <div class="column-items column-items2">
                                    <div class="column-item">
                                        @include('admin.includes.input', [
                                            'label' => 'Тема диссертационной работы:',
                                            'name' => "topic-{$work->year}",
                                            'value' => $work->topic ?? '',
                                        ])
                                    </div>
                                    <div class="column-item">
                                        @include('admin.includes.input', [
                                            'label' => 'Год обучения',
                                            'name' => "year-{$work->year}",
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
                                                'name' => "scientific_head-{$work->year}",
                                                'value' => $work->scientific_head ?? '',
                                            ])
                                        </div>
                                        <div class="column-item">
                                            @include('admin.includes.input', [
                                                'label' => 'Должность',
                                                'name' => "post-{$work->year}",
                                                'value' => $work->post ?? '',
                                            ])
                                        </div>
                                    </div>
                                    <div class="column-item">
                                        @include('admin.includes.input', [
                                            'label' => 'Научная степень',
                                            'name' => "scientific_degree-{$work->year}",
                                            'value' => $work->scientific_degree ?? '',
                                        ])
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <legend>Документы</legend>
                                    {!! \App\Helpers\GenerateForm::makeFile(
                                        'Реферат',
                                        "workReport-{$work->year}-2",
                                        $object->certainDocument('Реферат', $work->year),
                                        '/storage',
                                        field: 'path',
                                    ) !!}
                                    {!! \App\Helpers\GenerateForm::makeFile(
                                        'Индивидуальный план<br> научной деятельности<br> по годам/семестрам',
                                        "individualPlan-{$work->year}-12",
                                        $object->certainDocument('Индивидуальный план научной деятельности по годам/семестрам', $work->year),
                                        '/storage',
                                        field: 'path',
                                    ) !!}
                                    {!! \App\Helpers\GenerateForm::makeFile(
                                        'План научной деятельности<br> по годам',
                                        "yearPlan-{$work->year}-13",
                                        $object->certainDocument('План научной деятельности по годам', $work->year),
                                        '/storage',
                                        field: 'path',
                                    ) !!}
                                    {!! \App\Helpers\GenerateForm::makeFile(
                                        'Отзыв научного<br> руководителя-14',
                                        "review-{$work->year}",
                                        $object->certainDocument('Отзыв научного руководителя', $work->year),
                                        '/storage',
                                        field: 'path',
                                    ) !!}
                                    {!! \App\Helpers\GenerateForm::makeFile(
                                        'Выписка из протокола<br> семинара',
                                        "extract-{$work->year}-15",
                                        $object->certainDocument('Выписка из протокола семинара', $work->year),
                                        '',
                                        field: 'path',
                                    ) !!}
                                    {!! \App\Helpers\GenerateForm::makeFile(
                                        'Протокол отчета<br> на Ученом совете',
                                        "protocol-{$work->year}-16",
                                        $object->certainDocument('Протокол отчета на Ученом совете', $work->year),
                                        '/storage/pa',
                                        field: 'path',
                                    ) !!}
                                </fieldset>
                            </div>
                        </fieldset>
                    @endforeach
                </div>

            </fieldset>

            <fieldset>
                <legend>Индивидуальные достижения</legend>
                <fieldset>
                    <legend>Публикации</legend>
                    {!! \App\Helpers\GenerateForm::makeFile(
                        'Материалы конференций',
                        'materials',
                        $object->certainDocument('Материалы конференций'),
                        '/storage/pa',
                        field: 'path',
                    ) !!}
                    {!! \App\Helpers\GenerateForm::makeFile(
                        'Тезисы докладов',
                        'thesis',
                        $object->certainDocument('Тезисы докладов'),
                        '/storage/pa',
                        field: 'path',
                    ) !!}
                    {!! \App\Helpers\GenerateForm::makeFile(
                        'Статьи',
                        'article',
                        $object->certainDocument('Статьи'),
                        '/storage/pa',
                        field: 'path',
                    ) !!}
                    {!! \App\Helpers\GenerateForm::makeFile(
                        'РИД',
                        'rid',
                        $object->certainDocument('РИД'),
                        '/storage/pa',
                        field: 'path',
                    ) !!}
                    {!! \App\Helpers\GenerateForm::makeFile(
                        'Другое',
                        'other',
                        $object->certainDocument('Другое'),
                        '/storage/pa',
                        field: 'path',
                    ) !!}
                    {!! \App\Helpers\GenerateForm::makeFile(
                        'Отчет аспиранта',
                        'aspirantReport',
                        $object->certainDocument('Отчет аспиранта'),
                        '/storage/pa',
                        field: 'path',
                    ) !!}
                </fieldset>
            </fieldset>

            <fieldset>
                <legend>Экзаменационная ведомость</legend>
                {!! \App\Helpers\GenerateForm::makeFile(
                    'Философия',
                    'philosophy',
                    $object->certainDocument('Философия'),
                    '/storage/pa',
                    field: 'path',
                ) !!}
                {!! \App\Helpers\GenerateForm::makeFile(
                    'Английский язык',
                    'english',
                    $object->certainDocument('Английский язык'),
                    '/storage/pa',
                    field: 'path',
                ) !!}
                {!! \App\Helpers\GenerateForm::makeFile(
                    'Специальность',
                    'specialtyDoc',
                    $object->certainDocument('Специальность'),
                    '/storage/pa',
                    field: 'path',
                ) !!}
            </fieldset>

            @include('admin.includes.submit')

        </form>
    </div>

    <script src="/lib/jquery.min.js"></script>
    <script>
        $(".file_delete").on("click", function(e) {
            e.preventDefault();
            console.log(1);
        });
    </script>
@endsection
