@extends('layouts.default')
@section('content')
    <div class="page page_ip">
        <div class="page__container page_ip__container container">
            <div class="breadcrumbs">
                <div class="breadcrumbs__container">
                    <div class="breadcrumbs__grid _flex">
                        <a href="#" class="breadcrumbs__item">Главная</a>
                        <span class="breadcrumbs__slash">/</span> 
                        <span class="breadcrumbs__item">Структура ГГИ</span>
                    </div>
                </div>
            </div>
            <h1 class="page_ip__title page-title">Выполнение научно-исследовательских работ</h1>
            <div class="page_ip__image page__banner">
                <picture class="page__banner-picture">
                    <img class="page_ip__img page__banner-img" src="/images/ip-banner.png" alt="clever man">
                </picture>
            </div>
            <div class="page_ip__notice notice">Объекты интеллектуальной собственности ФГБУ "ГГИ"</div>
            <div class="page_ip__links">
                <a href="#" class="page_ip__link">Приказ №30од от 03.03.2022 "Об актуализации Положения о правовой охране результатов интеллектуального труда и управлению объектами интеллектуальной собственности </a>
                <a href="#" class="page_ip__link">ППоложение о правовой охране результатов интеллектуальной деятельности (РИД) и управлению объектами интеллектуальной собственности (ОИС) ФГБУ "ГГИ" </a>
            </div>
         
            <div class="table__wrapper">
                <table class="table">
                    <thead class="table__head">
                        <tr class="table__row table__row_head">
                            <th class="table__head-cell table__head-cell_number">№</th>
                            <th class="table__head-cell table__head-cell_year">2023 год</th>
                            <th class="table__head-cell table__head-cell_name">Название</th>
                        </tr>
                    </thead>
                    <tbody class="table__body">
                        <tr class="table__row">
                            <td class="table__cell table__cell_number">1</td>
                            <td class="table__cell table__cell_year">БД</td>
                            <td class="table__cell table__cell_name">
                                <p class="table__cell_name__text">Программа управления геопорталом «Опасные гидрологические явления</p>
                                <br/>
                                <a class="table__cell_name__link _with_underline" href="#">Уведомление (Роспатент)</a>
                                &nbsp; &nbsp;
                                <a class="table__cell_name__link _with_underline" href="#">Описание</a>
                                
                            </td>
                        </tr>
                        <tr class="table__row">
                            <td class="table__cell table__cell_number">2</td>
                            <td class="table__cell table__cell_year">ПрЭВМ</td>
                            <td class="table__cell table__cell_name">
                                <p class="table__cell_name__text">Программа управления геопорталом «Опасные гидрологические явления</p>
                                <br/>
                                <a class="table__cell_name__link _with_underline" href="#">Уведомление (Роспатент)</a>
                                &nbsp; &nbsp;
                                <a class="table__cell_name__link _with_underline" href="#">Описание</a>
                            </td>
                        </tr>
                        <tr class="table__row table__row_head">
                            <td class="table__head-cell table__head-cell_number"></td>
                            <td class="table__head-cell table__head-cell_year">2022 год</td>
                            <td class="table__head-cell table__head-cell_name"></td>
                        </tr>
                        <tr class="table__row">
                            <td class="table__cell table__cell_number">3</td>
                            <td class="table__cell table__cell_year">ПрЭВМ</td>
                            <td class="table__cell table__cell_name">
                                <a href="#">Автоматизированная информационная система "Краткосрочный гидрологический прогноз"</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
@endsection