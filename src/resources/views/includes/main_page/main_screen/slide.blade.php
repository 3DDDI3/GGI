<div class="main-screen-slider__slide js-main-screen-slider__slide swiper-slide">
    <picture class="main-screen-slider__banner-picture">
        <img src="{{$image}}" alt="{{$title}}" class="main-screen-slider__banner-img">
    </picture>
    <div class="main-screen-slider__dark-film"></div>
    <div class="main-screen-slider__container container container_fluid">
        <div class="main-screen-slider__grid _flex">
            <div class="main-screen-slider__primary">
                <span class="main-screen-slider__border-text border-text">
                    {{__('Новости')}}
                </span>
            </div>
            <div class="main-screen-slider__secondary">
                <div class="main-screen-slider__content">
                    <div class="main-screen-slider__content-blue-blur blue-blur"></div>
                    <div class="main-screen-slider__content-body">
                        @if ($date) 
                            <div class="main-screen-slider__date">{{$date}}</div>
                        @endif
                        @if ($title)
                            <h2 class="main-screen-slider__title">{{$title}}</h2>
                        @endif
                        @if ($subtitle)
                            <p class="main-screen-slider__subtitle">{{$subtitle}}</p>
                        @endif
                        <button class="button button_transparent">{{__('Подробнее')}}</button>
                    </div>
                </div>
            </div>
            <div class="main-screen-slider__tertiary">
                @if (!empty($photos))
                    <div class="main-screen-slider__photos-slider photos-slider js-photos-slider swiper">
                        <div class="photos-slider__wrapper swiper-wrapper">
                            @foreach ($photos as $photo)
                                <div class="photos-slider__slide swiper-slide">
                                    <picture class="photos-slider__picture">
                                        <img src="{{$photo['src']}}" alt="{{$photo['alt'] ?? ''}}" class="photos-slider__img">
                                    </picture>
                                </div>
                            @endforeach
                        </div>
                        @include('includes.main_page.main_screen.navigation', ['slider' => 'photos-slider'])
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>