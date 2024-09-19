<div class="{{$slider}}__navigation js-{{$slider}}__navigation slider-navigation">
    <button type="button" class="{{$slider}}__arrow {{$slider}}__arrow_left slider-navigation__arrow slider-navigation__arrow_left swiper-button-prev">
        <svg xmlns="http://www.w3.org/2000/svg" width="56" height="12" viewBox="0 0 56 12" fill="none">
            <g clip-path="url(#clip0_16_81)">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.04953 7.44666L8.04953 12.3158L-0.339982 6.05577L8.04953 -0.204261L8.04953 4.66454L55.5902 4.66453L55.5902 7.44666L8.04953 7.44666Z" fill="white"/>
            </g>
            <defs>
            <clipPath id="clip0_16_81">
            <rect width="56" height="12" fill="white" transform="translate(56 12) rotate(180)"/>
            </clipPath>
            </defs>
        </svg>
    </button>
    <a href="{{route('news.index')}}" class="{{$slider}}__link slider-navigation__link title text-line text-line_right">
        {{__('Все новости')}}
    </a>
    <button type="button" class="{{$slider}}__arrow {{$slider}}__arrow_right slider-navigation__arrow slider-navigation__arrow_right swiper-button-next">
        <svg xmlns="http://www.w3.org/2000/svg" width="56" height="12" viewBox="0 0 56 12" fill="none">
            <g clip-path="url(#clip0_16_84)">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M47.9505 4.55334V-0.315796L56.34 5.94423L47.9505 12.2043V7.33547L0.40979 7.33547L0.40979 4.55334L47.9505 4.55334Z" fill="white"/>
            </g>
            <defs>
            <clipPath id="clip0_16_84">
            <rect width="56" height="12" fill="white"/>
            </clipPath>
            </defs>
        </svg>
    </button>
</div>
