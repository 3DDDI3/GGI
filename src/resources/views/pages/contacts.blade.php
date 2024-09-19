@extends('layouts.default')
@section('content')
    <div class="page">
        <div class="page__container container container_1400">

            {!! \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('page', $page) !!}

            <h1 class="page__title page-title">{{($page->{___('name')})}}</h1>


            <div class="page_branches__cards _flex">
                @if($setting->director_reception_phone)
                    <div class="page_branches__card">
                        <div class="page_branches__card-title notice notice_top">{{__('Телефон приёмной')}} <br>
                            {{__('директора')}}:</div>
                        <div class="dictionary-list__value">{{ $setting->director_reception_phone }}</div>
                        <div class="media media--contacts">
                            @if ($setting->link1)
                                <a href="{{ $setting->link1 }}" class="media__item media__item--meteorf"></a>
                            @endif
                            @if ($setting->link2)
                                <a href="{{ $setting->link2 }}" class="media__item media__item--vk"></a>
                            @endif
                        </div>
                    </div>
                @endif

                @if($setting->director_reception_email)
                    <div class="page_branches__card">
                        <div class="page_branches__card-title notice notice_top">{{__('Адрес электронной почты приёмной директора')}}:</div>
                        <a href="mailto:{{ $setting->director_reception_email }}" class="page_branches__link">{{ $setting->director_reception_email }}</a>
                    </div>
                @endif

                @if($setting->contact_page_address)
                    <div class="page_branches__card">
                        <div class="page_branches__card-title notice notice_top">{{__('Наши координаты')}}:</div>
                        <div class="page_branches__card-text branches__card-small-text">{!! $setting->{___('contact_page_address')} !!}</strong>
                        </div>
                    </div>
                @endif

                <div class="page_branches__card">
                    <div class="page_branches__card-title notice notice_top">{{__('Другие телефоны и адреса смотрите в разделе')}}:</div>
                    <a href="/administraciia" class="page_branches__link">{{__('Администрация')}}</a>
                    <a href="{{route('structure.index')}}" class="page_branches__link">{{__('Отделы')}}</a>
                </div>
            </div>


            <div class="page__text contact-page__text">
                {!! ($page->{___('text')}) !!}
            </div>
            @if ($page->{___('text_2')})
                <div class="page__text contact-page__text page__text_2">
                    {!! ($page->{___('text_2')}) !!}
                </div>
            @endif

            @if (!$page->files->isEmpty())
            <div class="page__links">
                @foreach ($files_links as $file_link)
                    <br/>
                    <br/>
                    <a href="{{asset('storage/'.$file_link['path'])}}" class="page__link" download>{{$file_link['name']}}</a>
                @endforeach
            </div>
            @endif

            <a href="{{route('eform')}}" class="page_contacts__eform button button_with_blue_shadow">{{__('Электронная форма обращений')}}</a>
        </div>
        
    </div>

    {{-- @include('includes.main_page.map_section') --}}

@endsection
