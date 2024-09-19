<div class="section section_board">
    <div class="section_board__container container container_1400">
        <div class="section_board__board board">
            <div class="board__grid _flex">
                <div class="board__grid-item board__grid-item_primary">
                    <div class="board__head _flex">
                        <h3 class="board__title title title_white">{{ __('Новости') }}</h3>
                        <a href="{{ route('news.index') }}" class="board__link">{{ __('Все новости') }}</a>
                    </div>
                    <div class="board__list js-board-news board-news swiper">
                        <div class="swiper-wrapper board-news__container">
                            @if (!$board_news->isEmpty())
                                @foreach ($board_news as $board_news_item)
                                    <div class="board-news__item swiper-slide">
                                        <div class="board-news__item-container">
                                            <div class="board-news__head _flex">

                                                <div class="board-news__date">
                                                    @if ($board_news_item->news->date)
                                                        <span
                                                            class="board-news__day">{{ date('d/m', $board_news_item->news->date) }}</span>
                                                        <span
                                                            class="board-news__year">{{ date('Y', $board_news_item->news->date) }}</span>
                                                    @endif
                                                </div>


                                                <a href="{{ route('news.single', ['link' => $board_news_item->link]) }}"
                                                    class="board-news__arrow">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="56"
                                                        height="12" viewBox="0 0 56 12" fill="none">
                                                        <g clip-path="url(#clip0_16_317)">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M47.9505 4.55334V-0.315796L56.34 5.94423L47.9505 12.2043V7.33547L0.40979 7.33547L0.40979 4.55334L47.9505 4.55334Z"
                                                                fill="#00ADEF" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_16_317">
                                                                <rect width="56" height="12" fill="white" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                </a>
                                            </div>
                                            <div class="board-news__title">
                                                {{ $board_news_item->{___('name')} ?? '' }}
                                            </div>
                                            <div class="board-news__text">
                                                {{ $board_news_item->news->{___('preview_text')} ?? '' }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        @include('includes.main_page.main_screen.navigation', ['slider' => 'board-news'])
                    </div>
                </div>
                <div class="board__grid-item board__grid-item_secondary">
                    <div class="board__head _flex">
                        <h3 class="board__title title title_white">{{ __('Портфолио') }}</h3>
                        {{-- <a href="#" class="board__link">{{__('Все портфолио')}}</a> --}}
                    </div>
                    <div class="board__list board-portfolio js-board-portfolio swiper">
                        <div class="swiper-wrapper board-portfolio__container">
                            @if (!$portfolio->isEmpty())
                                @foreach ($portfolio as $portfolio_item)
                                    <div class="board-portfolio__item swiper-slide">
                                        <div class="board-portfolio__item-container">
                                            <div class="board-portfolio__grid">

                                                <div class="board-portfolio__content">
                                                    <div class="board-portfolio__title">
                                                        {{ $portfolio_item->{___('name')} ?? '' }}</div>


                                                        <div class="board-portfolio__title">
                                                            {!! $portfolio_item->{___('text')} ?? '' !!}
                                                        </div>

                                                    {{-- <div class="board-portfolio__customer-area"> --}}
                                                    {{-- <div class="board-portfolio__customer-title">{{__('Заказчик')}}:</div> --}}
                                                    {{-- <div class="board-portfolio__customer-name">{{$portfolio_item->portfolio->{___('customer')} ?? ''}}</div> --}}
                                                    {{-- </div> --}}
                                                </div>

                                                @if ($portfolio_item->portfolioDoc())
                                                    <a download
                                                        href="{{ asset('storage/' . $portfolio_item->portfolioDoc()->path) }}">
                                                        <picture class="board-portfolio__picture" style="display: flex;
                                                        justify-content: center;">
                                                            @if ($portfolio_item->image)
                                                                <img class="board-portfolio__img"
                                                                    src="{{ asset('storage/' . $portfolio_item->image) }}"
                                                                    alt="{{ $portfolio_item->{___('name')} ?? '' }}">
                                                            @endif
                                                        </picture>
                                                    </a>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        @include('includes.main_page.main_screen.navigation', [
                            'slider' => 'board-portfolio',
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
