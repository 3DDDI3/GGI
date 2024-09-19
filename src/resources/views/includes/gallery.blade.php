@if (!empty($images))
    <div class="gallery {{$class ?? ''}}">
        <div class="gallery__main-slider js-gallery__main-slider swiper">
            <div class="gallery__main-slider-wrapper js-gallery__main-slider-wrapper swiper-wrapper">
                @foreach ($images as $image)
                    <div class="gallery__main-slider-slide js-gallery__main-slider-slide swiper-slide">
                        <picture class="gallery__main-slider-picture">
                            <img src="{{$image['src'] ?? ''}}" alt="{{$image['alt'] ?? ''}}" class="gallery__main-slider-img">
                        </picture>
                    </div>
                @endforeach
            </div>
            @if (!empty($arrows_top))   
                @include('includes.gallery.navigation')
            @endif
        </div>
        <div class="gallery__thumbs-slider js-gallery__thumbs-slider swiper">
            <div class="gallery__thumbs-slider-wrapper js-gallery__thumbs-slider-wrapper swiper-wrapper">
                @foreach ($images as $image)
                    <div class="gallery__thumbs-slider-slide js-gallery__thumbs-slider-slide swiper-slide">
                        <picture class="gallery__thumbs-slider-picture">
                            <img src="{{$image['src'] ?? ''}}" alt="{{$image['alt'] ?? ''}}" class="gallery__thumbs-slider-img">
                        </picture>
                    </div>
                @endforeach
            </div>
            @if (empty($arrows_top))
                @include('includes.gallery.navigation')
            @endif
        </div>
    </div>
@endif