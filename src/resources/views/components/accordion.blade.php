<div class="accordion__item js-accordion__item arrows-list__item">
    <button type="button" class="accordion__head js-accordion__head">
        <div class="accordion__container arrows-list__container">
            <div class="accordion__grid arrow-list__grid _flex _space_between">
                <div class="accordion__title arrows-list__title">{{$title}}&nbsp;</div>
                @if (!empty($title2))
                    <div class="accordion__title-2">{{$title2}}</div>
                @endif
                <div class="accordion__key"></div>
            </div>
        </div>
    </button>
    <div class="accordion__body js-accordion__body">
        {!! $slot !!}
    </div>
</div>
