@extends('pa.main')

@section('main')
    <div class="container">
        <aside class="sidebar">
            <nav class="nav">
                <ul class="nav__list">
                    <li class="nav__item logo">
                        <a href="index.html" class="logo__nav">
                            <div class="nav__wrapp-img">
                                <img src="{{ asset('images/pa/logo-img-1.png') }}"
                                    alt="Логотип Государственного гидрологического института" class="nav__img" />
                            </div>
                            <div class="sidebar__wrapp-title">
                                <h2 class="sidebar__title">
                                    Государственный гидрологический институт
                                </h2>
                                <p class="sidebar__desc">
                                    Федеральное&nbsp;государственное бюджетное&nbsp;учреждение
                                </p>
                            </div>
                        </a>
                    </li>
                    <li class="nav__item active">
                        <a href="#" class="nav__link" data-target="data">
                            <div class="wrapp-svg">
                                <svg class="nav-svg" width="18" height="20" viewBox="0 0 18 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9 9.75C11.6234 9.75 13.75 7.62335 13.75 5C13.75 2.37665 11.6234 0.25 9 0.25C6.37665 0.25 4.25 2.37665 4.25 5C4.25 7.62335 6.37665 9.75 9 9.75Z"
                                        fill="#008DF2" />
                                    <path
                                        d="M17.47 15.32L17.34 15C16.9031 13.9024 16.152 12.9582 15.1807 12.2857C14.2094 11.6133 13.0612 11.2425 11.88 11.22H6.13002C4.94888 11.2425 3.80069 11.6133 2.82939 12.2857C1.85809 12.9582 1.1069 13.9024 0.670019 15L0.530019 15.31C0.311941 15.8105 0.220663 16.3571 0.26427 16.9013C0.307877 17.4455 0.485024 17.9706 0.780019 18.43C1.02023 18.8223 1.35668 19.1467 1.75745 19.3724C2.15823 19.5982 2.61004 19.7178 3.07002 19.72H14.92C15.3813 19.7176 15.8345 19.598 16.2368 19.3723C16.6392 19.1467 16.9775 18.8224 17.22 18.43C17.5125 17.9714 17.6882 17.4482 17.7318 16.9061C17.7754 16.3639 17.6855 15.8194 17.47 15.32Z"
                                        fill="#008DF2" />
                                </svg>
                            </div>
                            <p class="nav__text">Персональные данные</p>
                        </a>
                    </li>
                    <li class="nav__item">
                        <a href="#" class="nav__link" data-target="achievement">
                            <div class="wrapp-svg">
                                <svg class="nav-svg" width="20" height="23" viewBox="0 0 20 23" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.49584 18.4281C7.70359 18.4832 7.79689 18.721 7.67292 18.8966L4.99745 22.6875C4.77994 23.0025 4.29994 22.98 4.11244 22.635L3.19745 20.9325C3.02495 20.61 2.71745 20.3925 2.35745 20.3325L0.444946 20.0475C0.0624457 19.9875 -0.125054 19.545 0.0999456 19.23L2.51765 15.7998C2.62887 15.6419 2.852 15.6295 2.9858 15.7687C4.19884 17.0303 5.75112 17.9657 7.49584 18.4281Z"
                                        fill="#008DF2" />
                                    <path
                                        d="M19.5399 19.905L17.6349 20.2575C17.2824 20.325 16.9749 20.55 16.8174 20.88L15.9543 22.6136C15.7829 22.958 15.3093 23.0019 15.0774 22.695L12.2317 18.928C12.0987 18.7518 12.1924 18.5049 12.4064 18.4504C14.1633 18.0032 15.7326 17.0783 16.9625 15.822C17.0938 15.6879 17.3094 15.6975 17.4225 15.8473L19.8624 19.08C20.0949 19.3875 19.9224 19.83 19.5399 19.905Z"
                                        fill="#008DF2" />
                                    <path
                                        d="M10 0.75C5.44 0.75 1.75 4.44 1.75 9C1.75 13.56 5.44 17.25 10 17.25C14.56 17.25 18.25 13.56 18.25 9C18.25 4.44 14.56 0.75 10 0.75ZM13.54 9.0975L12.6775 9.945C12.4825 10.1325 12.3925 10.4025 12.4375 10.6725L12.64 11.8575C12.76 12.5325 12.055 13.0425 11.455 12.7275L10.3825 12.165C10.1425 12.0375 9.8575 12.0375 9.6175 12.165L8.545 12.7275C7.945 13.0425 7.24 12.5326 7.36 11.8575L7.5625 10.6725C7.6075 10.4025 7.5175 10.1325 7.3225 9.945L6.46 9.0975C5.9725 8.625 6.2425 7.8 6.9175 7.695L8.11 7.5225C8.38 7.485 8.6125 7.32 8.7325 7.0725L9.265 5.9925C9.565 5.385 10.435 5.385 10.735 5.9925L11.2675 7.0725C11.3875 7.32 11.62 7.485 11.89 7.5225L13.0825 7.695C13.7575 7.8 14.0275 8.625 13.54 9.0975Z"
                                        fill="#008DF2" />
                                </svg>
                            </div>
                            <p class="nav__text">Индивидуальные достижения</p>
                        </a>
                    </li>
                    @if ($acount->acount_type_id == 2)
                        <li class="nav__item" id="examLink">
                            <a href="#" class="nav__link" data-target="exam">
                                <div class="wrapp-svg">
                                    <svg class="nav-svg" width="21" height="21" viewBox="0 0 21 21" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M2.856 20.58H13.272C11.424 19.572 10.164 17.64 10.164 15.372C10.164 12.096 12.852 9.40804 16.128 9.40804H16.212V2.60404C16.212 1.42804 15.204 0.420044 14.028 0.420044H2.856C1.68 0.420044 0.671997 1.42804 0.671997 2.60404V18.396C0.671997 19.572 1.596 20.58 2.856 20.58ZM4.788 3.78004H12.012C12.516 3.78004 12.852 4.20004 12.852 4.62004C12.852 5.12404 12.516 5.46004 12.012 5.46004H4.788C4.284 5.46004 3.948 5.12404 3.948 4.62004C3.948 4.20004 4.368 3.78004 4.788 3.78004ZM4.788 7.72804H9.492C9.996 7.72804 10.332 8.14804 10.332 8.56804C10.332 9.07204 9.996 9.40804 9.492 9.40804H4.788C4.284 9.40804 3.948 9.07204 3.948 8.56804C3.948 8.06404 4.368 7.72804 4.788 7.72804Z"
                                            fill="#008DF2" />
                                        <path
                                            d="M16.128 11.172C13.776 11.172 11.844 13.104 11.844 15.456C11.844 17.808 13.776 19.74 16.128 19.74C18.48 19.74 20.412 17.808 20.412 15.456C20.412 13.104 18.48 11.172 16.128 11.172ZM18.228 15.036L16.128 17.052C15.96 17.22 15.792 17.304 15.54 17.304C15.288 17.304 15.12 17.22 14.952 17.052L13.944 15.96C13.608 15.624 13.608 15.12 14.028 14.784C14.364 14.448 14.868 14.448 15.204 14.784L15.624 15.288L17.136 13.86C17.472 13.524 17.976 13.524 18.312 13.86C18.564 14.112 18.564 14.7 18.228 15.036Z"
                                            fill="#008DF2" />
                                    </svg>
                                </div>
                                <p class="nav__text">Экзаменационная ведомость</p>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <section class="header main-container">
                <div id="popup" class="popup">
                    <div class="popup__content">
                        <p class="popup__text">Вы действительно хотите выйти?</p>
                        <div class="popup__btns">
                            <button class="popup__btn" id="yesBtn">Да</button>
                            <button class="popup__btn" id="noBtn">Нет</button>
                        </div>
                    </div>
                </div>
                <button class="header__btn user-btn">
                    <img src='{{ $acount->icon == null ? '/images/pa/person.svg' : "/storage/$acount->icon" }}'
                        alt="аватарка пользователя" />{{ $acount->firstName }}
                </button>

                <button id="logOut" class="header__btn exit-btn">
                    <svg width="21" height="21" viewBox="0 0 21 21" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_1091_2090)">
                            <path
                                d="M13.5437 15.7592C13.5437 15.2155 13.103 14.7748 12.5593 14.7748C12.0156 14.7748 11.5749 15.2155 11.5749 15.7592C11.5749 17.2203 10.3861 18.4088 8.92533 18.4088H4.82344C3.3623 18.4088 2.17383 17.2203 2.17383 15.7592V5.2408C2.17383 3.77965 3.3623 2.59119 4.82344 2.59119H8.92533C10.3865 2.59119 11.5749 3.77998 11.5749 5.2408C11.5749 5.7845 12.0156 6.22517 12.5593 6.22517C13.103 6.22517 13.5437 5.7845 13.5437 5.2408C13.5437 2.69422 11.4719 0.622437 8.92533 0.622437H4.82344C2.27686 0.622437 0.205078 2.69422 0.205078 5.2408V15.7595C0.205078 18.3061 2.27686 20.3779 4.82344 20.3779H8.92533C11.4719 20.3779 13.5437 18.3057 13.5437 15.7592Z"
                                fill="#373042" />
                            <path
                                d="M15.0872 6.65831C14.7453 7.0806 14.81 7.70076 15.2326 8.04267L17.0504 9.51562H6.87427C6.33056 9.51562 5.88989 9.95629 5.88989 10.5C5.88989 11.0437 6.33056 11.4844 6.87427 11.4844H17.0507L15.2326 12.957C14.9924 13.1516 14.8677 13.4357 14.8677 13.7225C14.8677 13.9401 14.9396 14.1592 15.0872 14.3417C15.4295 14.764 16.0493 14.8289 16.4716 14.4867C16.4716 14.4867 20.4455 11.2678 20.4495 11.2649C20.9167 10.8865 20.9046 10.1164 20.4495 9.73514L16.4716 6.51328C16.049 6.17104 15.4291 6.23601 15.0872 6.65831Z"
                                fill="#373042" />
                        </g>
                        <defs>
                            <clipPath id="clip0_1091_2090">
                                <rect width="21" height="21" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                </button>
            </section>
            <section class="body-container">
                <div class="main main-container data active">
                    <form action="#!" method="post" enctype="multipart/form-data" class="main__form">
                        <ul class="main__list">
                            <li class="main__item wrapp-title">
                                <h2 class="main__title">Персональные данные</h2>
                                {{-- <section class="switch-container">
                                    <input type="radio" id="option1" name="switch" checked />
                                    <input type="radio" id="option2" name="switch" />
                                    <div class="switch">
                                        <label for="option1" class="switch-option">
                                            <span class="switch-text">Абитуриент</span>
                                        </label>
                                        <label for="option2" class="switch-option">
                                            <span class="switch-text">Аспирант</span>
                                        </label>
                                    </div>
                                </section> --}}
                            </li>
                            <li class="main__item initials">
                                <div id="image-container" class="image-container">
                                    <input type="file" id="file-input" accept="image/*" />
                                    <img id="image-preview" class="image-preview" src="/storage/{{ $acount->icon }}"
                                        style="{{ !empty($acount->icon) ? 'display: block' : '' }}" alt="Image Preview" />
                                </div>
                                <ul class="main__list-person">
                                    <li class="main__item-person">
                                        <input class="main__input" type="text" value="{{ $acount->lastName }}"
                                            name="lastName" placeholder="Фамилия" aria-label="Фамилия" />
                                    </li>
                                    <li class="main__item-person">
                                        <input class="main__input" type="text" value="{{ $acount->firstName }}"
                                            name="firstName" placeholder="Имя" aria-label="Имя" />
                                    </li>
                                    <li class="main__item-person">
                                        <input class="main__input" type="text" value="{{ $acount->secondName }}"
                                            name="secondName" placeholder="Отчество" aria-label="Отчество" />
                                    </li>
                                    <li class="main__item-person">
                                        <input class="main__input" type="email" value="{{ $acount->email }}"
                                            name="email" pattern=".+@example\.com" placeholder="E-mail"
                                            aria-label="E-mail" />
                                    </li>
                                </ul>
                            </li>
                            <li class="main__item mainInfo">
                                <h3 class="main__subtitle">
                                    Основная информация
                                    <div class="tooltip-icon hidden">
                                        <div class="tooltip__container">
                                            <div class="tooltip__status">
                                                <p class="toolltip__name"></p>
                                                <p class="tooltip__date"></p>
                                                <p class="tooltip__time"></p>
                                            </div>
                                            <p class="tooltip__alert">Измените название файла</p>
                                        </div>
                                    </div>
                                </h3>
                                <ul class="main__list-mainInfo">
                                    <li class="main__item-mainInfo">
                                        <label for="input" class="main__label main__input">
                                            <input class="main__input-date" type="date" id="input"
                                                style="{{ !empty($acount->birthday) ? 'color:#5b5b5b' : '' }}"
                                                value="{{ $acount->birthday->format('Y-m-d') }}" max="2030-01-01" />
                                            <span style="{{ !empty($acount->birthday) ? 'color:transparent' : '' }}"
                                                class="label-span"></span></span>
                                        </label>
                                        <input type="text" class="main__input" name="studyPlace"
                                            placeholder="Место учебы" value="{{ $acount->study_place }}"
                                            aria-label="Место учебы" />
                                    </li>
                                    <li class="main__item-mainInfo">
                                        <input type="text" class="main__input" value="{{ $acount->specialty }}"
                                            name="specialty" placeholder="Специальность" aria-label="Специальность" />
                                    </li>
                                </ul>
                            </li>
                            <li class="main__item document-uploads abit {{ $acount->acount_type_id == 1 ? 'hidden' : '' }}"
                                id="abit">
                                <ul class="main__list-files grid-container">
                                    <li class="main__item-files first-item">
                                        <h3 class="main__subtitle achievement__subtitle">
                                            Диплом
                                            <div
                                                class="tooltip-icon {{ $acount->certainComment('Диплом', $acount->id, 1)->count() > 0 ? '' : ' hidden' }}">
                                                <div class="tooltip__container">
                                                    <div class="tooltip__status">
                                                        <p class="toolltip__name"></p>
                                                        <p class="tooltip__date"></p>
                                                        <p class="tooltip__time"></p>
                                                    </div>
                                                    @foreach ($acount->certainComment('Диплом', $acount->id, 1) as $comment)
                                                        <p class="tooltip__alert">
                                                            {{ $comment->comment }}
                                                        </p>
                                                    @break
                                                @endforeach
                                            </div>
                                        </div>
                                    </h3>
                                    <label class="input-file">
                                        <input type="file" id="diploma" data-page="Персональные данные" multiple
                                            aria-label="Диплом" data-send="1" name="diploma" />
                                        <span>Выбрать файл</span>
                                    </label>
                                    <ul id="passport-files" class="input-file-list">
                                        @foreach ($documents as $document)
                                            @if (
                                                $document->document->type == 'Диплом' &&
                                                    $document->agent->acount_type_id == 2 &&
                                                    $document->page->page == 'Персональные данные')
                                                <li class="input-file-list-item">
                                                    <div class="input-file-svg"></div><span
                                                        class="input-file-list-name">{{ $document->path }}</span><a
                                                        class="input-file-list-remove">x</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="main__item-files second-item">
                                    <h3 class="main__subtitle achievement__subtitle">
                                        Реферат
                                        <div
                                            class="tooltip-icon {{ $acount->certainComment('Реферат', $acount->id, 1)->count() > 0 ? '' : ' hidden' }}">
                                            <div class="tooltip__container">
                                                <div class="tooltip__status">
                                                    <p class="toolltip__name"></p>
                                                    <p class="tooltip__date"></p>
                                                    <p class="tooltip__time"></p>
                                                </div>
                                                @foreach ($acount->certainComment('Реферат', $acount->id, 1) as $comment)
                                                    <p class="tooltip__alert">
                                                        {{ $comment->comment }}
                                                    </p>
                                                @break
                                            @endforeach
                                        </div>
                                    </div>
                                </h3>
                                <label class="input-file">
                                    <input type="file" id="report" multiple aria-label="Реферат"
                                        name="report" data-send="1" data-page="Персональные данные" />
                                    <span>Выбрать файл</span>
                                </label>
                                <ul id="report-files" class="input-file-list">
                                    @foreach ($documents as $document)
                                        @if (
                                            $document->document->type == 'Реферат' &&
                                                $document->agent->acount_type_id == 2 &&
                                                $document->page->page == 'Персональные данные')
                                            <li class="input-file-list-item">
                                                <div class="input-file-svg"></div><span
                                                    class="input-file-list-name">{{ $document->path }}</span><a
                                                    class="input-file-list-remove">x</a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="main__item document-uploads">
                        <ul class="main__list-files grid-container">
                            <li class="main__item-files first-item">
                                <h3 class="main__subtitle achievement__subtitle">
                                    Паспорт
                                    <div
                                        class="tooltip-icon {{ !empty($acount->passport_comment) ? '' : ' hidden' }}">
                                        <div class="tooltip__container">
                                            <div class="tooltip__status">
                                                <p class="toolltip__name"></p>
                                                <p class="tooltip__date"></p>
                                                <p class="tooltip__time"></p>
                                            </div>
                                            <p class="tooltip__alert">
                                                {{ $acount->passport_comment }}
                                            </p>
                                        </div>
                                    </div>
                                </h3>
                                <label class="input-file">
                                    <input type="file" id="passport" name="passport" multiple
                                        aria-label="Выбрать файл паспорта" />
                                    <span>Выбрать файл</span>
                                </label>
                                <ul id="passport-files" class="input-file-list">
                                    @if (!empty($acount->passport))
                                        <li class="input-file-list-item">
                                            <div class="input-file-svg"></div><span
                                                class="input-file-list-name">{{ $acount->passport }}</span><a
                                                class="input-file-list-remove">x</a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                            <li class="main__item-files second-item">
                                <h3 class="main__subtitle achievement__subtitle">
                                    СНИЛС
                                    <div
                                        class="tooltip-icon {{ !empty($acount->snils_comment) ? '' : ' hidden' }}">
                                        <div class="tooltip__container">
                                            <div class="tooltip__status">
                                                <p class="toolltip__name"></p>
                                                <p class="tooltip__date"></p>
                                                <p class="tooltip__time"></p>
                                            </div>
                                            <p class="tooltip__alert">
                                                {{ $acount->snils_comment }}
                                            </p>
                                        </div>
                                    </div>
                                </h3>
                                <label class="input-file">
                                    <input type="file" id="snils" name="snils" multiple
                                        aria-label="Выбрать файл СНИЛС" />
                                    <span>Выбрать файл</span>
                                </label>
                                <ul id="snils-files" class="input-file-list">
                                    @if (!empty($acount->snils))
                                        <li class="input-file-list-item">
                                            <div class="input-file-svg"></div><span
                                                class="input-file-list-name">{{ $acount->snils }}</span><a
                                                class="input-file-list-remove">x</a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                            <li class="main__item-files third-item">
                                <h3 class="main__subtitle achievement__subtitle">
                                    ИНН
                                    <div class="tooltip-icon {{ !empty($acount->inn_comment) ? '' : ' hidden' }}">
                                        <div class="tooltip__container">
                                            <div class="tooltip__status">
                                                <p class="toolltip__name"></p>
                                                <p class="tooltip__date"></p>
                                                <p class="tooltip__time"></p>
                                            </div>
                                            <p class="tooltip__alert">
                                                {{ $acount->inn_comment }}
                                            </p>
                                        </div>
                                    </div>
                                </h3>
                                <label class="input-file">
                                    <input type="file" id="inn" name="inn" multiple
                                        aria-label="Выбрать файл ИНН" />
                                    <span>Выбрать файл</span>
                                </label>
                                <ul id="inn-files" class="input-file-list">
                                    @if (!empty($acount->inn))
                                        <li class="input-file-list-item">
                                            <div class="input-file-svg"></div><span
                                                class="input-file-list-name">{{ $acount->inn }}</span><a
                                                class="input-file-list-remove">x</a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="main__item diploma{{ $acount->acount_type_id == 1 ? '' : ' hidden' }}"
                        id="diplomSec">
                        <ul class="main__list-diploma">
                            <li class="main__item-diploma">
                                <h3 class="main__subtitle achievement__subtitle">
                                    Тема диссертационной работы
                                    <div class="tooltip-icon hidden">
                                        <div class="tooltip__container">
                                            <div class="tooltip__status">
                                                <p class="toolltip__name"></p>
                                                <p class="tooltip__date"></p>
                                                <p class="tooltip__time"></p>
                                            </div>
                                            <p class="tooltip__alert">
                                                Измените название файла
                                            </p>
                                        </div>
                                    </div>
                                </h3>
                                <label>
                                    <input type="text" class="main__input" name="thesisTopic"
                                        placeholder="Тема диссертационной работы"
                                        aria-label="Тема диссертационной работы"
                                        value="{{ $acount->works()->first()?->topic }}" />
                                </label>
                            </li>
                            <li class="main__item-diploma">
                                <!-- <label> -->
                                <h3 class="main__subtitle achievement__subtitle">
                                    Год обучения
                                    <div class="tooltip-icon hidden">
                                        <div class="tooltip__container">
                                            <div class="tooltip__status">
                                                <p class="toolltip__name"></p>
                                                <p class="tooltip__date"></p>
                                                <p class="tooltip__time"></p>
                                            </div>
                                            <p class="tooltip__alert">
                                                Измените название файла
                                            </p>
                                        </div>
                                    </div>
                                </h3>
                                <label for="date-select">
                                    <select id="date-select" data-year="{{ $acount->admission_year }}"
                                        name="date"></select>
                                </label>
                            </li>
                        </ul>
                    </li>
                    <li class="main__item name-scientist{{ $acount->acount_type_id == 1 ? '' : ' hidden' }}"
                        id="scientist">
                        <h3 class="main__subtitle">
                            Научный руководитель
                            <div class="tooltip-icon hidden">
                                <div class="tooltip__container">
                                    <div class="tooltip__status">
                                        <p class="toolltip__name"></p>
                                        <p class="tooltip__date"></p>
                                        <p class="tooltip__time"></p>
                                    </div>
                                    <p class="tooltip__alert">Измените название файла</p>
                                </div>
                            </div>
                        </h3>
                        <ul class="main__list-scientist">
                            <li class="main__item-scientist">
                                <input type="text" name="fullNameScientist" class="main__input"
                                    placeholder="Ф.И.О." aria-label="Ф.И.О."
                                    value="{{ $acount->works()->first()?->scientific_head }}" />
                                <input type="text" name="positionScientist" class="main__input"
                                    placeholder="Должность" aria-label="Должность"
                                    value="{{ $acount->works()->first()?->post }}" />
                            </li>
                            <li class="main__item-scientist">
                                <input type="text" class="main__input" name="scientificDegree"
                                    placeholder="Научная степень" aria-label="Научная степень"
                                    value="{{ $acount->works()->first()?->scientific_degree }}" />
                            </li>
                        </ul>
                    </li>
                    <li class="main__item additional-files {{ $acount->acount_type_id == 1 ? '' : 'hidden' }}"
                        id="additional">
                        <ul class="main__list-plan">
                            <li class="main__item-plan">
                                <div class="inner-title">
                                    <h3 class="main__subtitle">
                                        Реферат
                                        <div
                                            class="tooltip-icon {{ $acount->certainComment('Реферат', $acount->id, 1)->count() > 0 ? '' : ' hidden' }}">
                                            <div class="tooltip__container">
                                                <div class="tooltip__status">
                                                    <p class="toolltip__name"></p>
                                                    <p class="tooltip__date"></p>
                                                    <p class="tooltip__time"></p>
                                                </div>
                                                @foreach ($acount->certainComment('Диплом', $acount->id, 1) as $comment)
                                                    <p class="tooltip__alert"> {{ $comment->comment }}</p>
                                                @break
                                            @endforeach
                                        </div>
                                    </div>
                                </h3>
                                <label class="input-file">
                                    <input type="file" id="report" multiple name="personalFiles"
                                        aria-label="Реферат" />
                                    <span>Выбрать файл</span>
                                </label>
                                <ul id="passport-files" class="input-file-list">
                                    @foreach ($documents as $document)
                                        @if ($document->document->type == 'Реферат' && $document->agent->acount_type_id == 1)
                                            <li class="input-file-list-item">
                                                <div class="input-file-svg"></div><span
                                                    class="input-file-list-name">{{ $document->path }}</span><a
                                                    class="input-file-list-remove">x</a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                        <li class="main__item-plan">
                            <div class="inner-title">
                                <h3 class="main__subtitle">
                                    Индивидуальный план научной деятельности по
                                    годам/семестрам
                                    <div
                                        class="tooltip-icon {{ $acount->certainComment('Индивидуальный план научной деятельности по годам/семестрам', $acount->id, 1)->count() > 0 ? '' : ' hidden' }}">
                                        <div class="tooltip__container">
                                            <div class="tooltip__status">
                                                <p class="toolltip__name"></p>
                                                <p class="tooltip__date"></p>
                                                <p class="tooltip__time"></p>
                                            </div>
                                            @foreach ($acount->certainComment('Индивидуальный план научной деятельности по годам/семестрам', $acount->id, 1) as $comment)
                                                <p class="tooltip__alert">{{ $comment->comment }}</p>
                                            @break
                                        @endforeach
                                    </div>
                                </div>
                            </h3>
                            <label class="input-file">
                                <input type="file" id="individualPlan" multiple name="personalFiles"
                                    aria-label="Индивидуальный план научной деятельности по годам/семестрам" />
                                <span>Выбрать файл</span>
                            </label>
                            <ul id="individualPlan-files" class="input-file-list">
                                @foreach ($documents as $document)
                                    @if (
                                        $document->document->type == 'Индивидуальный план научной деятельности по годам/семестрам' &&
                                            $document->agent->acount_type_id == 1)
                                        <li class="input-file-list-item">
                                            <div class="input-file-svg"></div><span
                                                class="input-file-list-name">{{ $document->path }}</span><a
                                                class="input-file-list-remove">x</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    <li class="main__item-plan">
                        <div class="inner-title">
                            <h3 class="main__subtitle">
                                План научной деятельности по годам
                                <div
                                    class="tooltip-icon {{ $acount->certainComment('План научной деятельности по годам', $acount->id, 1)->count() > 0 ? '' : ' hidden' }}">
                                    <div class="tooltip__container">
                                        <div class="tooltip__status">
                                            <p class="toolltip__name"></p>
                                            <p class="tooltip__date"></p>
                                            <p class="tooltip__time"></p>
                                        </div>
                                        @foreach ($acount->certainComment('План научной деятельности по годам', $acount->id, 1) as $comment)
                                            <p class="tooltip__alert">{{ $comment->comment }} </p>
                                        @break
                                    @endforeach
                                </div>
                            </div>
                        </h3>
                        <label class="input-file">
                            <input type="file" id="annualPlan" multiple name="personalFiles"
                                aria-label="План научной деятельности по годам" />
                            <span>Выбрать файл</span>
                        </label>
                        <ul id="annualPlan-files" class="input-file-list">
                            @foreach ($documents as $document)
                                @if ($document->document->type == 'План научной деятельности по годам' && $document->agent->acount_type_id == 1)
                                    <li class="input-file-list-item">
                                        <div class="input-file-svg"></div><span
                                            class="input-file-list-name">{{ $document->path }}</span><a
                                            class="input-file-list-remove">x</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </li>
                <li class="main__item-plan">
                    <div class="inner-title">
                        <h3 class="main__subtitle">
                            Отзыв научного руководителя
                            <div
                                class="tooltip-icon {{ $acount->certainComment('Отзыв научного руководителя', $acount->id, 1)->count() > 0 ? '' : ' hidden' }}">
                                <div class="tooltip__container">
                                    <div class="tooltip__status">
                                        <p class="toolltip__name"></p>
                                        <p class="tooltip__date"></p>
                                        <p class="tooltip__time"></p>
                                    </div>
                                    @foreach ($acount->certainComment('Отзыв научного руководителя', $acount->id, 1) as $comment)
                                        <p class="tooltip__alert">{{ $comment->comment }}</p>
                                    @break
                                @endforeach
                            </div>
                        </div>
                    </h3>
                    <label class="input-file">
                        <input type="file" id="supervisorReview" multiple name="personalFiles"
                            aria-label="Отзыв научного руководителя" />
                        <span>Выбрать файл</span>
                    </label>
                    <ul id="supervisorReview-files" class="input-file-list">
                        @foreach ($documents as $document)
                            @if ($document->document->type == 'Отзыв научного руководителя' && $document->agent->acount_type_id == 1)
                                <li class="input-file-list-item">
                                    <div class="input-file-svg"></div><span
                                        class="input-file-list-name">{{ $document->path }}</span><a
                                        class="input-file-list-remove">x</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </li>
            <li class="main__item-plan">
                <div class="inner-title">
                    <h3 class="main__subtitle">
                        Выписка из протокола семинара
                        <div
                            class="tooltip-icon {{ $acount->certainComment('Выписка из протокола семинара', $acount->id, 1)->count() > 0 ? '' : ' hidden' }}">
                            <div class="tooltip__container">
                                <div class="tooltip__status">
                                    <p class="toolltip__name"></p>
                                    <p class="tooltip__date"></p>
                                    <p class="tooltip__time"></p>
                                </div>
                                @foreach ($acount->certainComment('Выписка из протокола семинара', $acount->id, 1) as $comment)
                                    <p class="tooltip__alert"> {{ $comment->comment }}</p>
                                @break
                            @endforeach
                        </div>
                    </div>
                </h3>
                <label class="input-file">
                    <input type="file" id="seminarProtocol" multiple name="personalFiles"
                        aria-label="Выписка из протокола семинара" />
                    <span>Выбрать файл</span>
                </label>
                <ul id="seminarProtocol-files" class="input-file-list">
                    @foreach ($documents as $document)
                        @if ($document->document->type == 'Выписка из протокола семинара' && $document->agent->acount_type_id == 1)
                            <li class="input-file-list-item">
                                <div class="input-file-svg"></div><span
                                    class="input-file-list-name">{{ $document->path }}</span><a
                                    class="input-file-list-remove">x</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </li>
        <li class="main__item-plan">
            <div class="inner-title">
                <h3 class="main__subtitle">
                    Протокол отчета на Ученом совете
                    <div
                        class="tooltip-icon {{ $acount->certainComment('Протокол отчета на Ученом совете', $acount->id, 1)->count() > 0 ? '' : ' hidden' }}">
                        <div class="tooltip__container">
                            <div class="tooltip__status">
                                <p class="toolltip__name"></p>
                                <p class="tooltip__date"></p>
                                <p class="tooltip__time"></p>
                            </div>
                            @foreach ($acount->certainComment('Протокол отчета на Ученом совете', $acount->id, 1) as $comment)
                                <p class="tooltip__alert">{{ $comment->comment }}</p>
                            @break
                        @endforeach
                    </div>
                </div>
            </h3>
            <label class="input-file">
                <input type="file" id="councilReport" multiple name="personalFiles"
                    aria-label="Протокол отчета на Ученом совете" />
                <span>Выбрать файл</span>
            </label>
            <ul id="councilReport-files" class="input-file-list">
                @foreach ($documents as $document)
                    @if ($document->document->type == 'Протокол отчета на Ученом совете' && $document->agent->acount_type_id == 1)
                        <li class="input-file-list-item">
                            <div class="input-file-svg"></div><span
                                class="input-file-list-name">{{ $document->path }}</span><a
                                class="input-file-list-remove">x</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </li>
</ul>
</li>
</ul>
</form>
</div>
<div class="main main-container achievement">
<form action="#!" method="post" enctype="multipart/form-data" class="main__form achievement">
<h2 class="main__title achievement__title">
Индивидуальные достижения
</h2>
<div class="content-form {{ $acount->acount_type_id == 1 ? 'hidden' : '' }}" id="appForm">
<h3 class="achievement__heding">Загрузите свои документы</h3>
<ul class="achievement__list-input">
<li class="achievement-item__input">
    <h3 class="achievement__subtitle">
        Диплом
        <div
            class="tooltip-icon {{ $acount->certainComment('Диплом', $acount->id, 2)->count() > 0 ? '' : ' hidden' }}">
            <div class="tooltip__container">
                <div class="tooltip__status">
                    <p class="toolltip__name"></p>
                    <p class="tooltip__date"></p>
                    <p class="tooltip__time"></p>
                </div>
                @foreach ($acount->certainComment('Диплом', $acount->id, 2) as $comment)
                    <p class="tooltip__alert">{{ $comment->comment }}</p>
                @break
            @endforeach
        </div>
    </div>
</h3>
<label class="input-file">
    <input type="file" id="diplomaApp" name="diplomaApp" multiple
        aria-label="Диплом" />
    <span>Выбрать файл</span>
</label>
<ul id="diplomaApp-files" class="input-file-list">
    @foreach ($documents as $document)
        @if (
            $document->document->type == 'Диплом' &&
                $document->page->page == 'Индивидуальные достижения' &&
                $document->agent->acount_type_id == 2)
            <li class="input-file-list-item">
                <div class="input-file-svg"></div><span
                    class="input-file-list-name">{{ $document->path }}</span><a
                    class="input-file-list-remove">x</a>
            </li>
        @endif
    @endforeach
</ul>
</li>
<li class="achievement-item__input">
<h3 class="achievement__subtitle">
    Реферат
    <div class="tooltip-icon hidden">
        <div class="tooltip__container">
            <div class="tooltip__status">
                <p class="toolltip__name"></p>
                <p class="tooltip__date"></p>
                <p class="tooltip__time"></p>
            </div>
            <p class="tooltip__alert">Измените название файла</p>
        </div>
    </div>
</h3>
<label class="input-file">
    <input type="file" id="reportApp" name="reportApp" multiple
        aria-label="Реферат" />
    <span>Выбрать файл</span>
</label>
<ul id="reportApp-files" class="input-file-list">
    @foreach ($documents as $document)
        @if (
            $document->document->type == 'Реферат' &&
                $document->page->page == 'Индивидуальные достижения' &&
                $document->agent->acount_type_id == 2)
            <li class="input-file-list-item">
                <div class="input-file-svg"></div><span
                    class="input-file-list-name">{{ $document->path }}</span><a
                    class="input-file-list-remove">x</a>
            </li>
        @endif
    @endforeach
</ul>
</li>
<li class="achievement-item__input">
<h3 class="achievement__subtitle">
    Другое
    <div class="tooltip-icon hidden">
        <div class="tooltip__container">
            <div class="tooltip__status">
                <p class="toolltip__name"></p>
                <p class="tooltip__date"></p>
                <p class="tooltip__time"></p>
            </div>
            @foreach ($acount->certainComment('Другое', $acount->id, 2) as $comment)
                <p class="tooltip__alert">{{ $comment->path }}</p>
            @break
        @endforeach
    </div>
</div>
</h3>
<label class="input-file">
<input type="file" id="anotherApp" name="articleApp" multiple
    aria-label="Другое" />
<span>Выбрать файл</span>
</label>
<ul id="articleApp-files" class="input-file-list">
@foreach ($documents as $document)
    @if (
        $document->document->type == 'Другое' &&
            $document->page->page == 'Индивидуальные достижения' &&
            $document->agent->acount_type_id == 2)
        <li class="input-file-list-item">
            <div class="input-file-svg"></div><span
                class="input-file-list-name">{{ $document->path }}</span><a
                class="input-file-list-remove">x</a>
        </li>
    @endif
@endforeach
</ul>
</li>
</ul>
</div>
<div class="content-form {{ $acount->acount_type_id == 1 ? '' : 'hidden' }}" id="pgForm">
<h3 class="achievement__heding">Публикации</h3>
<ul class="achievement__list-input">
<li class="achievement-item__input">
<h3 class="achievement__subtitle">Материалы конференций</h3>
<label class="input-file">
<input type="file" id="materialConf" name="materialConf" multiple
    aria-label="Материалы конференций" />
<span>Выбрать файл</span>
</label>
<ul id="materialConf" class="input-file-list">
@foreach ($documents as $document)
    @if (
        $document->document->type == 'Материалы конференций' &&
            $document->page->page == 'Индивидуальные достижения' &&
            $document->agent->acount_type_id == 1)
        <li class="input-file-list-item">
            <div class="input-file-svg"></div><span
                class="input-file-list-name">{{ $document->path }}</span><a
                class="input-file-list-remove">x</a>
        </li>
    @endif
@endforeach
</ul>
</li>
<li class="achievement-item__input">
<h3 class="achievement__subtitle">Тезисы докладов</h3>
<label class="input-file">
<input type="file" id="thesisReport" name="thesisReport" multiple
    aria-label="Тезисы докладов" />
<span>Выбрать файл</span>
</label>
<ul id="thesisReport" class="input-file-list">
@foreach ($documents as $document)
    @if (
        $document->document->type == 'Тезисы докладов' &&
            $document->page->page == 'Индивидуальные достижения' &&
            $document->agent->acount_type_id == 1)
        <li class="input-file-list-item">
            <div class="input-file-svg"></div><span
                class="input-file-list-name">{{ $document->path }}</span><a
                class="input-file-list-remove">x</a>
        </li>
    @endif
@endforeach
</ul>
</li>
<li class="achievement-item__input">
<h3 class="achievement__subtitle">Статьи</h3>
<label class="input-file">
<input type="file" id="article" name="article" multiple
    aria-label="Статьи" />
<span>Выбрать файл</span>
</label>
<ul id="article" class="input-file-list"></ul>
</li>
<li class="achievement-item__input">
<h3 class="achievement__subtitle">РИД</h3>
<label class="input-file">
<input type="file" id="pid" name="pid" multiple aria-label="РИД" />
<span>Выбрать файл</span>
</label>
<ul id="pid" class="input-file-list">
@foreach ($documents as $document)
    @if (
        $document->document->type == 'Статьи' &&
            $document->page->page == 'Индивидуальные достижения' &&
            $document->agent->acount_type_id == 1)
        <li class="input-file-list-item">
            <div class="input-file-svg"></div><span
                class="input-file-list-name">{{ $document->path }}</span><a
                class="input-file-list-remove">x</a>
        </li>
    @endif
@endforeach
</ul>
</li>
<li class="achievement-item__input">
<h3 class="achievement__subtitle">Другое</h3>
<label class="input-file">
<input type="file" id="anotherPg" name="anotherPg" multiple
    aria-label="Другое" />
<span>Выбрать файл</span>
</label>
<ul id="anotherPg-files" class="input-file-list">
@foreach ($documents as $document)
    @if (
        $document->document->type == 'Другое' &&
            $document->page->page == 'Индивидуальные достижения' &&
            $document->agent->acount_type_id == 1)
        <li class="input-file-list-item">
            <div class="input-file-svg"></div><span
                class="input-file-list-name">{{ $document->path }}</span><a
                class="input-file-list-remove">x</a>
        </li>
    @endif
@endforeach
</ul>
</li>
<li class="achievement-item__input">
<h3 class="achievement__subtitle">Отчет аспиранта</h3>
<label class="input-file">
<input type="file" id="reportStudent" name="reportStudent" multiple
    aria-label="Отчет аспиранта" />
<span>Выбрать файл</span>
</label>
<ul id="reportStudent" class="input-file-list">
@foreach ($documents as $document)
    @if (
        $document->document->type == 'Отчет аспиранта' &&
            $document->page->page == 'Индивидуальные достижения' &&
            $document->agent->acount_type_id == 1)
        <li class="input-file-list-item">
            <div class="input-file-svg"></div><span
                class="input-file-list-name">{{ $document->path }}</span><a
                class="input-file-list-remove">x</a>
        </li>
    @endif
@endforeach
</ul>
</li>
</ul>
</div>
</form>
</div>
<div class="main main-container exam">
<form action="#!" method="post" enctype="multipart/form-data" class="main__form exam">
<h2 class="main__title achievement__title">
Экзаменационная ведомость
</h2>
<h3 class="achievement__heding">Загрузите свои документы</h3>
<ul class="achievement__list-input">
<li class="achievement-item__input">
<h3 class="achievement__subtitle">
Философия
<div
class="tooltip-icon {{ $acount->certainComment('Философия', $acount->id, 3)->count() > 0 ? '' : ' hidden' }}">
<div class="tooltip__container">
    <div class="tooltip__status">
        <p class="toolltip__name"></p>
        <p class="tooltip__date"></p>
        <p class="tooltip__time"></p>
    </div>
    @foreach ($acount->certainComment('Философия', $acount->id, 3) as $comment)
        <p class="tooltip__alert">{{ $comment->comment }}</p>
    @break
@endforeach
</div>
</div>
</h3>
<label class="input-file">
<input type="file" id="Philosophy" name="materialConf" multiple
aria-label="Философия" />
<span>Выбрать файл</span>
</label>
<ul id="materialConf" class="input-file-list">
@foreach ($documents as $document)
@if (
    $document->document->type == 'Философия' &&
        $document->page->page == 'Экзаменационная ведомость' &&
        $document->agent->acount_type_id == 2)
<li class="input-file-list-item">
    <div class="input-file-svg"></div><span
        class="input-file-list-name">{{ $document->path }}</span><a
        class="input-file-list-remove">x</a>
</li>
@endif
@endforeach
</ul>
</li>
<li class="achievement-item__input">
<h3 class="achievement__subtitle">
Английский язык
<div
class="tooltip-icon {{ $acount->certainComment('Английский язык', $acount->id, 3)->count() > 0 ? '' : ' hidden' }}">
<div class="tooltip__container">
<div class="tooltip__status">
    <p class="toolltip__name"></p>
    <p class="tooltip__date"></p>
    <p class="tooltip__time"></p>
</div>
@foreach ($acount->certainComment('Английский язык', $acount->id, 3) as $comment)
    <p class="tooltip__alert">{{ $comment->comment }}</p>
@break
@endforeach
</div>
</div>
</h3>
<label class="input-file">
<input type="file" id="thesisReport" name="thesisReport" multiple
aria-label="Английский язык" />
<span>Выбрать файл</span>
</label>
<ul id="thesisReport" class="input-file-list">
@foreach ($documents as $document)
@if (
    $document->document->type == 'Английский язык' &&
        $document->page->page == 'Экзаменационная ведомость' &&
        $document->agent->acount_type_id == 2)
<li class="input-file-list-item">
<div class="input-file-svg"></div><span
    class="input-file-list-name">{{ $document->path }}</span><a
    class="input-file-list-remove">x</a>
</li>
@endif
@endforeach
</ul>
</li>
<li class="achievement-item__input">
<h3 class="achievement__subtitle">
Специальность
<div
class="tooltip-icon {{ $acount->certainComment('Специальность', $acount->id, 3)->count() > 0 ? '' : ' hidden' }}">
<div class="tooltip__container">
<div class="tooltip__status">
<p class="toolltip__name"></p>
<p class="tooltip__date"></p>
<p class="tooltip__time"></p>
</div>
@foreach ($acount->certainComment('Специальность', $acount->id, 3) as $comment)
<p class="tooltip__alert">{{ $comment->comment }}</p>
@break
@endforeach
</div>
</div>
</h3>
<label class="input-file">
<input type="file" id="article" name="article" multiple
aria-label="Специальность" />
<span>Выбрать файл</span>
</label>
<ul id="article" class="input-file-list">
@foreach ($documents as $document)
@if (
    $document->document->type == 'Специальность' &&
        $document->page->page == 'Экзаменационная ведомость' &&
        $document->agent->acount_type_id == 2)
<li class="input-file-list-item">
<div class="input-file-svg"></div><span
class="input-file-list-name">{{ $document->path }}</span><a
class="input-file-list-remove">x</a>
</li>
@endif
@endforeach
</ul>
</li>
</ul>
</form>
</div>
</section>
</main>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/scripts/choices.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('/lib/jquery.min.js') }}"></script>
<script defer src="{{ asset('js/pa/script.js') }}"></script>
@endsection
