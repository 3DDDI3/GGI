@extends('layouts.default')
@section('content')
    <div class="page page_graduate">
        <div class="page__container page_graduate__container container container_1400">
            {!! \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('page', $page) !!}
            <h1 class="page__title page-title page_magazine__title">{{ $page->{___('name')} }}</h1>



            @if (!$departments->isEmpty())
            @foreach ($departments as $key => $department)
                    {{-- блок с галереей --}}
                    @if (!$department->gallery->isEmpty())
                        <div class="page_graduate__section page_graduate__section_1 contacts-hero _flex">
                            @if (count($department->gallery) < 2)
                            <div class="contacts-hero__primary">
                                    <div class="contacts-hero__image">
                                        <picture class="contacts-hero__picture">
                                            <img class="contacts-hero__img"
                                                src="{{ asset('storage/' . $department->gallery[0]->thumbnail) }}"
                                                alt="">
                                        </picture>
                                    </div>
                                    <div class="contacts-hero__buttons _flex">
                                        <a href="tel:88123233447"
                                            class="button button_grey button_br_10 contacts-hero__button contacts-hero__button_phone">8
                                            (812)
                                            323-34-47</a>
                                        <a href="mailto:aspirant@ggi.nw.ru"
                                            class="button button_clear-blue button_br_10 contacts-hero__button contacts-hero__button_email">aspirant@ggi.nw.ru</a>
                                    </div>
                                     </div>
                                @else
                                    <div class="section_graduate_gallery__primary">
                                        @include('includes.gallery', [
                                            'class' => 'page_course__gallery',
                                            'arrows_top' => true,
                                            'images' => $department->gallery->map(
                                                fn($a) => [
                                                    'src' => asset('storage/' . $a->thumbnail),
                                                    'alt' => $a->alt,
                                                ]),
                                        ])

                                    </div>
                                @endif
                                
                           
                            <div class="contacts-hero__secondary">
                                <div class="page-title page-title_36 contacts-hero__title">{{ $department->{___('name')} }}
                                </div>
                                {!! $department->{___('text')} !!}
                            </div>
                        </div>
                    @else
                        {{-- блок без галереи  --}}
                        {{-- блок сворачивается  --}}
                        @if ($department->model == 2)
                            <div class="accordion js-accordion arrows-list page_graduate__accordion">
                                <x-Accordion title="{{ $department->{___('name')} ?? '' }}" title_2="">
                                    {!! $department->{___('text')} !!}
                                </x-Accordion>
                            </div>
                            {{-- блок не сворачивается  --}}
                        @elseif ($department->model == 3)
                        <div class="page_graduate__grey-banner page_graduate__grey-banner_1 grey-banner">
                            <div class="grey-banner__container">
                                <div class="grey-banner__grid _flex _align_center _space_between">
                                    <div class="grey-banner__primary">
                                        <h2 class="grey-banner__title page-title page-title_50">{{ $department->{___('name')} }}<span class="page-title__blue-blur blue-blur"></span></h2>
                                        <p class="grey-banner__text">
                                            {!! $department->{___('text')} !!}
                                        </p>
                                    </div>
                                    @if ($department->link || $department->model)
                                        <div class="grey-banner__secondary">
                                            <div class="grey-banner__phones notice">
                                                <span class="grey-banner__phone" >{!! nl2br($department->link) !!}</span>
                                                {{-- <a href="{{$department->model}}" class="grey-banner__phone">{{$department->model}}</a> --}}
                                            </div>
                                        </div>
                                    @endif
                                    <div class="grey-banner__decoration-dots"></div>
                                </div>
                            </div>
                        </div>
                        @elseif ($department->model == 4)
                        <div class="section section_banner section_graduate_banner">
                            <div class="section_banner__banner banner banner_graduate">
                                <div class="banner__container">
                                    <div class="banner__grid _flex">
                                        <div class="banner__text">
                                            <h2 class="banner__title banner__title_48 title">{{ $department->{___('name')} }}</h2>     
                                        </div>
                                        <div class="banner__action">
                                            {!! $department->{___('text')} !!}
                                            {{-- <button class="banner__button button">{{__('Посмотреть')}}</button> --}}
                                        </div>
                                    </div>
                                </div>
                                <picture class="banner__picture">
                                    <img src="/images/grey-marble-column.jpg" alt="great marble column">
                                </picture>
                            </div>
                        </div>
                        @else
                            <div class="page_graduate__section page_graduate__section_2">
                                <div class="trait-list__title">{{ $department->{___('name')} }}</div>
                                {!! $department->{___('text')} !!}
                            </div>
                        @endif
                    @endif
                @endforeach
            @endif
        </div>
    </div>
@endsection
