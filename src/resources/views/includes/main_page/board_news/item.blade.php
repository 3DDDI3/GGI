<div class="board-news__item swiper-slide">
    <div class="board-news__item-container">
        <div class="board-news__head _flex">
            <div class="board-news__date">
                <span class="board-news__day">{{$day ?? ''}}</span>
                <span class="board-news__year">{{$year ?? ''}}</span>
            </div>
            <a href="#" class="board-news__arrow">
                <svg xmlns="http://www.w3.org/2000/svg" width="56" height="12" viewBox="0 0 56 12" fill="none">
                    <g clip-path="url(#clip0_16_317)">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M47.9505 4.55334V-0.315796L56.34 5.94423L47.9505 12.2043V7.33547L0.40979 7.33547L0.40979 4.55334L47.9505 4.55334Z" fill="#00ADEF"/>
                    </g>
                    <defs>
                    <clipPath id="clip0_16_317">
                    <rect width="56" height="12" fill="white"/>
                    </clipPath>
                    </defs>
                </svg>
            </a>
        </div>
        <div class="board-news__title">
            {{$title ?? ''}}
        </div>
        <div class="board-news__text">{{$text ?? ''}}</div>
    </div>
</div>