<div class="page_main__main-screen main-screen">
    <div class="main-screen__slider main-screen-slider js-main-screen-slider swiper">
        @include('includes.header', ['class' => 'page_main__header'])
        <div class="main-screen-slider__wrapper swiper-wrapper">
            @if (!$banner_news->isEmpty())
                @foreach ($banner_news as $banner_news_item)
                    @if ($banner_news_item->news && $banner_news_item->{___('name')})
                        <div class="main-screen-slider__slide js-main-screen-slider__slide swiper-slide">
                            <picture class="main-screen-slider__banner-picture">
                                <img src="{{asset('storage/'.$banner_news_item->image)}}" alt="{{$banner_news_item->{___('name')} ?? ''}}" class="main-screen-slider__banner-img">
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
                                                @if ($banner_news_item->news->date) 
                                                    <div class="main-screen-slider__date">{{date('d.m.Y', $banner_news_item->news->date) }}</div>
                                                @endif
                                                @if ($banner_news_item->{___('name')})
                                                    <h2 class="main-screen-slider__title">{{$banner_news_item->{___('name')} ?? ''}}</h2>
                                                @endif
                                                @if ($banner_news_item->news->{___('name2')})
                                                    <p class="main-screen-slider__subtitle">{{$banner_news_item->news->{___('name2')} ?? ''}}</p>
                                                @endif
                                                <a href="{{route('news.single', ['link'=> $banner_news_item->link])}}" class="button button_transparent">{{__('Подробнее')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-screen-slider__tertiary">
                                        @if (!$banner_news_item->news->gallery->isEmpty())
                                            <div class="main-screen-slider__photos-slider photos-slider js-photos-slider swiper">
                                                <div class="photos-slider__wrapper swiper-wrapper">
                                                    @foreach ($banner_news_item->news->gallery as $photo)
                                                        <div class="photos-slider__slide swiper-slide">
                                                            <picture class="photos-slider__picture">
                                                                <img src="{{asset('storage/'.$photo->original)}}" alt="{{$photo->alt ?? ''}}" class="photos-slider__img">
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
                    @endif
                @endforeach
            @endif

        </div>
        <div class="main-screen-slider__pagination-container container container_fluid">
            <div class="main-screen-slider__pagination swiper-pagination"></div>
        </div>
        @include('includes.main_page.main_screen.navigation', ['slider' => 'main-screen-slider'])
    </div>
</div>