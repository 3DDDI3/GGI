<li class="arrows-list__item news-list__item">
    <div class="arrows-list__container news-list__container">
        <div class="news-list__head board-news__head _flex _space_between">
            <div class="news-list__date board-news__date">
                <span class="board-news__day">{{$day ?? ''}}</span>
                <span class="board-news__year">{{$year ?? ''}}</span>
            </div>
            <div class="news-list__arrow board-news__arrow">
                <svg xmlns="http://www.w3.org/2000/svg" width="56" height="12" viewBox="0 0 56 12" fill="none">
                    <g clip-path="url(#clip0_128_16726)">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M47.9508 4.55334V-0.315796L56.3403 5.94423L47.9508 12.2043V7.33547L0.410156 7.33547L0.410156 4.55334L47.9508 4.55334Z" fill="#00ADEF"/>
                    </g>
                    <defs>
                      <clipPath id="clip0_128_16726">
                        <rect width="56" height="12" fill="white"/>
                      </clipPath>
                    </defs>
                  </svg>
            </div>
        </div>
        <a href="{{$link ?? '#'}}" class="news-list__title _without_underline">{{$title ?? ''}}</a>
        @if ($text)
            <p class="news-list__text">{{$text ?? ''}}</p>
        @endif
    </div>
</li>