@extends('layouts.default')
@section('content')
    <div class="page page_course">
        <div class="page__container page_course__container container container_1400">
            <div class="breadcrumbs">
                <div class="breadcrumbs__container">
                    <div class="breadcrumbs__grid _flex">
                        <a href="#" class="breadcrumbs__item">Главная</a>
                        <span class="breadcrumbs__slash">/</span> 
                        <a href="#" class="breadcrumbs__item">Образование </a>
                        <span class="breadcrumbs__slash">/</span> 
                        <a href="#" class="breadcrumbs__item">Курсы повышения квалификации</a>
                        <span class="breadcrumbs__slash">/</span> 
                        <span class="breadcrumbs__item">«Автоматизированный гидрологический комплекс (АГК). Акустические доплеровские профилографы»</span>
                    </div>
                </div>
            </div>
            <h1 class="page_course__title page-title">«Автоматизированный гидрологический комплекс (АГК). Акустические доплеровские профилографы»</h1>
            <div class="page_course__grid _flex _space_between">
                <div class="page_course__content">
                    <p class="page_course__paragraph">С 17 июня по 22 июня 2019 года на гидрометрическом полигоне «Яжелбицы» Валдайского филиала ФГБУ «Государственный гидрологический институт» (ВФ ФГБУ «ГГИ») будут проходить курсы для специалистов УГМС/ЦГМС по п. 4.2 Плана-проспекта ИПК Росгидромета на 2019 г. Тема: «Автоматизированный гидрологический комплекс АГК. Акустические доплеровские профилографы».</p>
                    <p class="page_course__paragraph">Проживание: возможно в общежитии ВФ ФГБУ «ГГИ» г. Валдай (стоимость проживания 450 руб./день) или в гостинице г. Валдай (бронировать гостиницу самостоятельно)</p>
                    <p class="page_course__paragraph">На курсах Вы узнаете о различных автоматических гидрологических комплексах. Познакомитесь с особенностями программного обеспечения, условиях эксплуатациии обработки результатов профилографов Rio Grande, Stream Pro и River Ray. Получите практические навыки по работе с приборами на реке Полометь.</p>
                    <div class="page_course__boxed-text boxed-text">
                        Просьба заранее направить по электронной почте заявку по прилагаемой форме на участие в два адреса: в ФГБУ «ГГИ» и в ФГБОУ ДПО «ИПК».
                        <br/><br/>
                        Адрес Валдайского филиала ФГБУ «ГГИ»: 175400, Россия, г. Валдай, Новгородская область, ул. Победы, д. 2.
                    </div>
                    <div class="page_course__buttons _flex _align_center">
                        <a href="#" class="button page_course__button">Заявка на участие</a>
                        <a href="#" class="page_course__link _with_underline">Расписание занятий</a>
                    </div>
                </div>
                @include('includes.gallery', ['class' => 'page_course__gallery', 'images' =>[
                    ['src' => '/images/handsome-young-girl.png'],
                    ['src' => '/images/gallery-1.png'],
                    ['src' => '/images/gallery-2.png'],
                    ['src' => '/images/gallery-3.png']
                ]])
            </div>

        </div>
    </div>
@endsection