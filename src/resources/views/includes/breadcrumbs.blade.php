@if (count($breadcrumbs))
    <div class="breadcrumbs">
        <div class="breadcrumbs__container">
            <div class="breadcrumbs__grid">
                <a href="/" class="breadcrumbs__item">{{__('Главная')}}</a>
                @foreach ($breadcrumbs as $breadcrumb)
                    <span class="breadcrumbs__slash">/</span> 
                    @if (!empty($breadcrumb->title))
                        @if ($breadcrumb->url && !$loop->last)
                            <a href="{{$breadcrumb->url}}" class="breadcrumbs__item">{{$breadcrumb->title}}</a>
                        @else
                            <span class="breadcrumbs__item">{{$breadcrumb->title}}</span>
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endif

