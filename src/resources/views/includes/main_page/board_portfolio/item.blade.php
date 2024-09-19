<div class="board-portfolio__item swiper-slide">
    <div class="board-portfolio__item-container">
        <div class="board-portfolio__grid _flex">
            <picture class="board-portfolio__picture">
                @if ($image)
                    <img class="board-portfolio__img" src="{{$image}}" alt="{{$title ?? ''}}">
                @endif
            </picture>
            <div class="board-portfolio__content">
                <div class="board-portfolio__title">{{$title ?? ''}}</div>
                <div class="board-portfolio__customer-area">
                    {{-- <div class="board-portfolio__customer-title">Заказчик:</div> --}}
                    {{-- <div class="board-portfolio__customer-name">{{$customer_name ?? ''}}</div> --}}
                </div>
            </div>
        </div>
    </div>
</div>