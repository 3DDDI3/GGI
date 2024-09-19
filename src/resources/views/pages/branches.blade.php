@extends('layouts.default')
@section('content')
<div class="page page_branches">
    <div class="page__container page_branches__container container">

        {!! \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('page', $page) !!}

        <h1 class="page__title page-title">{{($page->{___('name')})}}</h1>

        @if (!$branches->isEmpty())
            <div class="js-tabs-wrapper">

                <div class="page_branches__tabs js-tabs _flex">
                    @php($i = 1)
                    @foreach ($branches as $branch)
                        <button type="button" class="page_branches__tab js-tab tab {{ $loop->first ? 'tab-active' : '' }}" data-box="{{ $i }}">{{__($branch->name)}}</button>
                        @php($i++)
                    @endforeach
                </div>

                <div class="page_branches__tabs-boxes js-tabs-boxes">
                    @php($i = 1)
                    @foreach ($branches as $branch)
                        <div class="page_branches__tab-box js-tab-box tab-box {{ $loop->first ? 'tab-box-active' : '' }}" data-tab="{{ $i }}">

                            <div class="page_branches__map-wrapper map__wrapper">
                                <div class="page_branches__map map js-map" id="map-{{ $i }}"></div>
                                <div class="map__content">
                                    <div class="map__container">
                                        <div class="map__grid _flex">
                                            <div class="map__text-block">
                                                <div class="map__text-block-container">
                                                    <div class="map__text-block-title notice notice_bottom">{{__('Контакты')}}:</div>
                                                    <div class="map__text-block-text">{{($branch->{___('description')})}}</div>
                                                    <div class="map__text-block-dictionary">
                                                        <div class="map__text-block-dictionary-title">{{__('Наши координаты')}}:</div>
                                                        <div class="map__text-block-dictionary-value">{{$branch->coordinates}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($branch->image)
                                                <div class="map__image">
                                                    <picture class="map__picture">
                                                        <img src="/storage/{{ $branch->image }}" alt="{{($branch->{___('description')})}}" class="map__img">
                                                    </picture>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="page_branches__text">{!! $branch->{___('text')} !!}</div>

                            <div class="page_branches__cards _flex">
                                @if($branch->phone || $branch->fax)
                                    <div class="page_branches__card">
                                        <ul class="page_branches__dictionary-list dictionary-list clear-list">
                                            @if($branch->phone)
                                                <li class="dictionary-list__item">
                                                    <div class="dictionary-list__title">{{__('Телефон')}}:</div>
                                                    <div class="dictionary-list__value">{{ $branch->phone }}</div>
                                                </li>
                                            @endif
                                            @if($branch->fax)
                                                <li class="dictionary-list__item">
                                                    <div class="dictionary-list__title">{{__('Факс')}}:</div>
                                                    <div class="dictionary-list__value">{{ $branch->fax }}</div>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                @endif

                                @if($branch->email)
                                    <div class="page_branches__card">
                                        <div class="page_branches__card-title notice notice_top">{{__('Адрес электронной почты')}}:</div>
                                        @foreach(explode(',', $branch->email) as $branch_email)
                                            <a href="mailto:{{ trim($branch_email) }}" class="page_branches__link _with_underline">{{ trim($branch_email) }}</a>
                                        @endforeach
                                    </div>
                                @endif

                                @if($branch->address)
                                    <div class="page_branches__card">
                                        <div class="page_branches__card-title notice notice_top">{{__('Наши координаты')}}:</div>
                                        <div class="page_branches__card-text">{!! $branch->address !!}</div>
                                    </div>
                                @endif
                            </div>


                            <div class="page_branches__text">{!! $branch->{___('text2')} !!}</div>

                        </div>
                        @php($i++)
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>

<script type="text/javascript" src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=65f27bd8-fc4e-4af1-a1e4-4427f8dc3a8b"></script>
<script type="text/javascript" src="{{asset('/js/ymaps.js')}}"></script>
<script type="text/javascript">
    
    @foreach ($branches as $i => $branch)
    @php($coord_array = explode(',', $branch->coordinates) )
        initMap('map-{{($i+1)}}', [
                    {
                        "type": "Feature",
                        "id": {{$i+1}},
                        "geometry": {
                            "type": "Point",
                            "coordinates": [
                                "{{ $coord_array[0] ?? '' }}",
                                "{{ $coord_array[1] ?? '' }}"
                            ]
                        },
                        "properties": {
                            "balloonText": "{{($branch->{___('description')})}}",
                            "balloonLink": "#"
                        },
                        "options": {
                            "preset": "mark#icon",
                            "hideIconOnBalloonOpen": false
                        }
                    }
                ], false, false);
    @endforeach

</script>
@endsection
