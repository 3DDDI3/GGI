<div class="section section_about">
    <div class="section_about__container container container_1400">
        <div class="section_about__top">
            <div class="section_about__primary">
                <h2 class="section_about__title page-title"> {!! ($setting->{___('main_info_title')}) ?? '' !!}</h2>
                <div class="section_about__notice notice">
                    {!!   ($setting->{___('main_info_quote')}) ?? '' !!}
                </div>
                <p class="section_about__text">
                    {!! ($setting->{___('main_info_text')}) ?? ''    !!}
                </p>
            </div>
            <div class="section_about__secondary _flex">
                <picture class="section_about__picture section_about__picture_1">
                    <img class="section_about__img section_about__img_1" src="/images/ggi-main-photo-1.jpg"
                        alt="">
                </picture>
                <picture class="section_about__picture section_about__picture_2">
                    <img class="section_about__img section_about__img_2" src="/images/ggi-main-photo-2.jpg"
                        alt="">
                </picture>
            </div>
        </div>
        <div class="section_about__bottom">
            <ul class="section_about__list _flex">
                {{-- <li class="section_about__list-item">{{ __('Практические занятия') }}</li> --}}
                {{-- <li class="section_about__list-item">{{ __('Реализация профессиональных умений') }}</li> --}}
                {{-- <li class="section_about__list-item">{{ __('Иностранных студентов из 40 стран мира') }}</li> --}}
                {{-- <li class="section_about__list-item">{{ __('Развитие научно-исследовательской работы') }}</li> --}}
            </ul>
        </div>
    </div>
</div>
