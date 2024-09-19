@extends('layouts.default')
@section('content')
<div class="page page_graduate">
    <div class="page__container page_graduate__container container container_1400">
        <div class="breadcrumbs">
            <div class="breadcrumbs__container">
                <div class="breadcrumbs__grid _flex">
                    <a href="#" class="breadcrumbs__item">Главная</a>
                    <span class="breadcrumbs__slash">/</span> 
                    <span class="breadcrumbs__item">Образование</span>
                    <span class="breadcrumbs__slash">/</span> 
                    <span class="breadcrumbs__item">Аспирантура</span>
                </div>
            </div>
        </div>
        <h1 class="page__title page-title">Аспирантура</h1>
        <div class="page_graduate__section page_graduate__section_1 contacts-hero _flex">
            <div class="contacts-hero__primary">
                <div class="contacts-hero__image">
                    <picture class="contacts-hero__picture">
                        <img class="contacts-hero__img" src="/images/handsome-young-girl-2.png" alt="">
                    </picture>
                </div>
                <div class="contacts-hero__buttons _flex">
                    <a href="tel:88123233447" class="button button_grey button_br_10 contacts-hero__button contacts-hero__button_phone">8 (812) 323-34-47</a>
                    <a href="mailto:aspirant@ggi.nw.ru" class="button button_clear-blue button_br_10 contacts-hero__button contacts-hero__button_email">aspirant@ggi.nw.ru</a>
                </div>
            </div>
            <div class="contacts-hero__secondary">
                <div class="page-title page-title_36 contacts-hero__title">О порядке приема на обучение в аспирантуру в 2023 г.</div>
                <div class="contacts-hero__notice notice">ФГБУ «ГГИ» объявляет прием на обучение в аспирантуре в 2023 г.</div>
                <div class="contacts-hero__dictionary contacts-hero__dictionary_1">
                    <div class="contacts-hero__dictionary-title">Количество бюджетных мест - 3</div>
                    <div class="contacts-hero__dictionary-value">Возможно поступление на платное обучение</div>
                </div>
                <div class="contacts-hero__dictionary contacts-hero__dictionary_2">
                    <div class="contacts-hero__dictionary-title">Прием производится на очное отделение по научной специальности:</div>
                    <a href="#" class="contacts-hero__dictionary-value">Возможно поступление на платное обучение</a>
                </div>
                <div class="contacts-hero__boxed boxed-text">
                    <div class="contacts-hero__boxed-title">Прием документов производится до <strong>11 августа 2023 г.</strong>:</div>
                    <ul class="contacts-hero__boxed-dictionary-list dictionary-list dictionary-list_boxed">
                        <li class="dictionary-list__item">
                            <div class="dictionary-list__title">Лично от поступающих представителем аспирантуры по адресу:</div>
                            <div class="dictionary-list__value">СПб, В.О. 2-я линия, д. 23. каб.102</div>
                        </li>
                        <li class="dictionary-list__item">
                            <div class="dictionary-list__title">По электронной почте:</div>
                            <a href="#" class="dictionary-list__value">docaspirant@ggi.nw.ru</a>
                        </li>
                        <li class="dictionary-list__item">
                            <div class="dictionary-list__title">По почте:</div>
                            <div class="dictionary-list__value">С199004, г. Санкт-Петербург, В,О. 2-я линия, д. 23</div>
                        </li>
                    </ul>
                </div>
            </div>
            
        </div>

        <div class="page_graduate__grey-banner page_graduate__grey-banner_1 grey-banner">
            <div class="grey-banner__container">
                <div class="grey-banner__grid _flex _align_center _space_between">
                    <div class="grey-banner__primary">
                        <h2 class="grey-banner__title page-title page-title_50">Условия приема <span class="page-title__blue-blur blue-blur"></span></h2>
                        <p class="grey-banner__text">
                            В аспирантуру ФГБУ «ГГИ» на конкурсной основе принимаются лица, имеющие высшее профессиональное образование (магистратура, специалитет)
                        </p>
                    </div>
                    <div class="grey-banner__decoration-dots"></div>
                </div>
            </div>
        </div>

        <div class="page_graduate__section page_graduate__section_2">
           <div class="trait-list__title">Для поступления в аспирантуру необходимо подать следующие документы:</div>
           <ul class="trait-list trait-list_graduate  clear-list">
              <li class="trait-list__item"><a href="#">Заявление о согласии на обработку персональных данных</a></li>
              <li class="trait-list__item"><a href="#">Заявление на русском языке о допуске к вступительным экзаменам на имя директора института</a></li>
              <li class="trait-list__item">Копии диплома и приложения к нему (документ иностранного государства об образовании предоставляется со свидетельством о признании иностранного образования)</li>
              <li class="trait-list__item"><a href="#">Личный листок</a></li>
              <li class="trait-list__item">2 фотографии (3х4)</li>
              <li class="trait-list__item">Список опубликованных научных работ с приложением их ксерокопии; лица, не имеющие опубликованных научных работ, представляют рефераты по научной специальности, по которой осуществляется подготовка в аспирантуре (объем реферата 15-20 страниц)</li>
              <li class="trait-list__item">Документы, свидетельствующие об индивидуальных достижениях поступающего, которые могут быть учтены приемной комиссией при подведении итогов конкурса (копии дипломов, почетных грамот и др. наград) согласно Порядку учета и перечню индивидуальных достижений поступающих в аспирантуру ФГБУ "ГГИ"</li>
              <li class="trait-list__item">Копию паспорта</li>
              <li class="trait-list__item">Копию СНИЛС​</li>
              <li class="trait-list__item">Копию ИНН</li>
              <li class="trait-list__item">Воинский билет (при наличии)</li>
           </ul>
        </div>

        <div class="page_graduate__section page_graduate__section_3 section section_graduate_gallery _flex _space_between">
            <div class="section_graduate_gallery__primary">
               @include('includes.gallery', ['class' => 'section_graduate_gallery__gallery', 'arrows_top' => true, 'images' =>[
                   ['src' => '/images/handsome-young-girl.png'],
                   ['src' => '/images/gallery-1.png'],
                   ['src' => '/images/gallery-2.png'],
                   ['src' => '/images/gallery-3.png']
                ]])
            </div>
            <div class="section_graduate_gallery__secondary">
                <div class="section_graduate_gallery__notice notice">Вступительные экзамены в аспирантуру проводятся очно
                    по дисциплинам «Общая гидрология» и «Иностранный язык».</div>
                <div class="section_graduate_gallery__dictionary">
                    <div class="section_graduate_gallery__dictionary-title">Приоритетной дисциплиной является</div>
                    <div class="section_graduate_gallery__dictionary-value">«Общая гидрология»</div>
                </div>
                <div class="section_graduate_gallery__dictionary">
                    <div class="section_graduate_gallery__dictionary-title">Принимаемые оценки при сдаче экзамена по дисциплине</div>
                    <div class="section_graduate_gallery__dictionary-value">«Общая гидрология» - «отлично» (5 баллов), «хорошо» (4 балла)</div>
                </div>
                <div class="section_graduate_gallery__dictionary">
                    <div class="section_graduate_gallery__dictionary-title">Принимаемые оценки при сдаче экзамена по дисциплине</div>
                    <div class="section_graduate_gallery__dictionary-value">«Иностранный язык» - «отлично» (5 баллов), «хорошо» (4 балла), «удовлетворительно» (3 балла)</div>
                </div>
                <div class="page_graduate_gallery__dividing dividing-line"></div>
                <div class="section_graduate_gallery__dictionary">
                    <div class="section_graduate_gallery__dictionary-title">Вступительные экзамены проводятся:</div>
                    <div class="section_graduate_gallery__dictionary-value">на данный момент срок не установлен</div>
                </div>
                <div class="section_graduate_gallery__dictionary">
                    <div class="section_graduate_gallery__dictionary-title">Заявление о согласии на зачисление подавать в приемную комиссию до:</div>
                    <div class="section_graduate_gallery__dictionary-value">на данный момент срок не установлен</div>
                </div>
                <div class="section_graduate_gallery__dictionary">
                    <div class="section_graduate_gallery__dictionary-title">Зачисление в аспирантуру по результатам конкурсного отбора производится:</div>
                    <div class="section_graduate_gallery__dictionary-value">31 августа 2023 г.</div>
                </div>
            </div>
        </div>

        <div class="page_graduate__section page_graduate__section_4">
            <div class="trait-list__title trait-list__title_bold">Приложения:</div>
            <ul class="trait-list trait-list_graduate clear-list">
               <li class="trait-list__item"><a href="#">Заявление о согласии на зачисление</a></li>
               <li class="trait-list__item"><a href="#">Перечень индивидуальных достижений, учитываемых при конкурсе</a></li>
               <li class="trait-list__item">Программы вступительных экзаменов: по <a href="#">Общей Гидрологии</a>, по <a href="#">Иностранному языку</a>.</li>
               <li class="trait-list__item"><a href="#">Лицензия </a> и <a href="#">Сведения о лицензируемом виде деятельности</a></li>
            </ul>
         </div>

         <div class="page_graduate__grey-banner page_graduate__grey-banner_2 grey-banner">
            <div class="grey-banner__container">
                <div class="grey-banner__grid _flex">
                    <div class="grey-banner__primary">
                        <p class="grey-banner__text">
                            Заведующая аспирантурой:
                        </p>
                        <h2 class="grey-banner__title page-title page-title_40">Белова Людмила Борисовна <span class="page-title__blue-blur blue-blur"></span></h2>
                        <p class="grey-banner__text">
                            Кабинет <a href="#">№ 102</a>
                        </p>
                    </div>
                    <div class="grey-banner__secondary">
                        <div class="grey-banner__phones notice">
                            <a href="#" class="grey-banner__phone">8 (812) 323-3447</a>
                            <a href="#" class="grey-banner__phone">8 (812) 323-0114</a>
                        </div>
                    </div>
                    <div class="grey-banner__decoration-dots"></div>
                </div>
            </div>
        </div>
        <div class="section section_banner section_graduate_banner">
            <div class="section_banner__banner banner banner_graduate">
                <div class="banner__container">
                    <div class="banner__grid _flex">
                        <div class="banner__text">
                            <h2 class="banner__title banner__title_48 title">Расписание занятий <br/> на <span class="title__accent">май 2023</span></h2>     
                        </div>
                        <div class="banner__action">
                            <button class="banner__button button">{{__('Посмотреть')}}</button>
                        </div>
                    </div>
                </div>
                <picture class="banner__picture">
                    <img src="/images/grey-marble-column.jpg" alt="great marble column">
                </picture>
            </div>
        </div>
        <div class="page_graduate__accordion accordion js-accordion arrows-list">
            <x-Accordion title="Документы для поступающих в аспирантуру в 2023 г. ФГТ (Федеральные государственные требования)">
                <a href="#">Порядок разработки и утверждения Основной программы подготовки научных и научно-педагогических кадров в аспирантуре ФГБУ "ГГИ"</a>
                <br/><br/>
                <a href="#">Порядок разработки и утверждения Основной программы подготовки научных и научно-педагогических кадров в аспирантуре ФГБУ "ГГИ"</a>
                <br/><br/>
                <a href="#">Порядок разработки и утверждения Основной программы подготовки научных и научно-педагогических кадров в аспирантуре ФГБУ "ГГИ"</a>
                <br/><br/>
                <a href="#">Порядок разработки и утверждения Основной программы подготовки научных и научно-педагогических кадров в аспирантуре ФГБУ "ГГИ"</a>
                <br/><br/>
                <a href="#">Порядок разработки и утверждения Основной программы подготовки научных и научно-педагогических кадров в аспирантуре ФГБУ "ГГИ"</a>
                <br/><br/>
                <a href="#">Порядок разработки и утверждения Основной программы подготовки научных и научно-педагогических кадров в аспирантуре ФГБУ "ГГИ"</a>
                <br/><br/>
                <a href="#">Порядок разработки и утверждения Основной программы подготовки научных и научно-педагогических кадров в аспирантуре ФГБУ "ГГИ"</a>
            </x-Accordion>
            <x-Accordion title="Документы для поступивших в аспирантуру до 2023 г. ФГОС (Федеральные государственные образовательные стандарты)">
                <a href="#">Порядок разработки и утверждения Основной программы подготовки научных и научно-педагогических кадров в аспирантуре ФГБУ "ГГИ"</a>
                <br/><br/>
                <a href="#">Порядок разработки и утверждения Основной программы подготовки научных и научно-педагогических кадров в аспирантуре ФГБУ "ГГИ"</a>
                <br/><br/>
                <a href="#">Порядок разработки и утверждения Основной программы подготовки научных и научно-педагогических кадров в аспирантуре ФГБУ "ГГИ"</a>
                <br/><br/>
                <a href="#">Порядок разработки и утверждения Основной программы подготовки научных и научно-педагогических кадров в аспирантуре ФГБУ "ГГИ"</a>
                <br/><br/>
                <a href="#">Порядок разработки и утверждения Основной программы подготовки научных и научно-педагогических кадров в аспирантуре ФГБУ "ГГИ"</a>
                <br/><br/>
                <a href="#">Порядок разработки и утверждения Основной программы подготовки научных и научно-педагогических кадров в аспирантуре ФГБУ "ГГИ"</a>
                <br/><br/>
                <a href="#">Порядок разработки и утверждения Основной программы подготовки научных и научно-педагогических кадров в аспирантуре ФГБУ "ГГИ"</a>
            </x-Accordion>
            <x-Accordion title="Общее">
                <a href="#">Порядок разработки и утверждения Основной программы подготовки научных и научно-педагогических кадров в аспирантуре ФГБУ "ГГИ"</a>
                <br/><br/>
                <a href="#">Порядок разработки и утверждения Основной программы подготовки научных и научно-педагогических кадров в аспирантуре ФГБУ "ГГИ"</a>
                <br/><br/>
                <a href="#">Порядок разработки и утверждения Основной программы подготовки научных и научно-педагогических кадров в аспирантуре ФГБУ "ГГИ"</a>
                <br/><br/>
                <a href="#">Порядок разработки и утверждения Основной программы подготовки научных и научно-педагогических кадров в аспирантуре ФГБУ "ГГИ"</a>
                <br/><br/>
                <a href="#">Порядок разработки и утверждения Основной программы подготовки научных и научно-педагогических кадров в аспирантуре ФГБУ "ГГИ"</a>
                <br/><br/>
                <a href="#">Порядок разработки и утверждения Основной программы подготовки научных и научно-педагогических кадров в аспирантуре ФГБУ "ГГИ"</a>
                <br/><br/>
                <a href="#">Порядок разработки и утверждения Основной программы подготовки научных и научно-педагогических кадров в аспирантуре ФГБУ "ГГИ"</a>
            </x-Accordion>
        </div>
        <a href="#" class="page_graduate__button button button_with_blue_shadow">ВХОД В ЛИЧНЫЙ КАБИНЕТ (ПОРТФОЛИО АСПИРАНТА)</a>
    </div>
</div>

@endsection
