@if (!empty($page) && $page->text_2 && $page->text_3)
<div class="section section_banner">
    <div class="section_banner__container container container_1400">
        <div class="section_banner__banner banner">
            <div class="banner__container">
                <div class="banner__grid _flex">
                    <picture class="banner__logo">
                        <img src="/images/svg/ggi-logo-2.svg" alt="{{__('Государственный гидрологический институт')}}">
                    </picture>
                    <div class="banner__text">
                        <div class="banner__subtitle">{{__('Аспирантура')}}</div>
                        <h2 class="banner__title title">{{__('День открытых')}}<br/>{{__('дверей')}}</h2>     
                    </div>
                    <div class="banner__action">
                        <div class="banner__date">
                            <span class="banner__day">{{$page->text_2}}</span>
                            &nbsp;
                            <span class="banner__time">{{$page->text_3}}</span>
                        </div>
                        <a href="/auth" class="banner__button button button_with_blue_shadow">{{__('Зарегистрироваться')}}</a>
                    </div>
                </div>
            </div>
            <picture class="banner__picture">
                <img src="/images/grey-marble-column.jpg" alt="great marble column">
            </picture>
        </div>
    </div>
</div>
@endif