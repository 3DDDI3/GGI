@extends('layouts.default')
@section('content')
    <div class="page page_about">
        <div class="page__container page_about__container container">
            {!! \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('page', $page) !!}

            <h1 class="page__title page-title page-title_with_decoration_dots">{{($page->{___('name')})}} <span class="page-title__small">({{__('Основные сведения')}})</span></h1>
            <ul class="dictionary-list">
                @if ($page->{___('text_2')})
                <li class="dictionary-list__item">
                    <div class="dictionary-list__title">{{__('Организационно-правовая форма')}}:</div>
                    <div class="dictionary-list__value">{{($page->{___('text_2')})}}</div>
                </li>
                @endif
                @if ($page->{___('text_3')})
                <li class="dictionary-list__item">
                    <div class="dictionary-list__title">{{__('Полное наименование')}}:</div>
                    <div class="dictionary-list__value">{{($page->{___('text_3')})}}</div>
                </li>
                @endif
                @if ($page->{___('text_4')})
                <li class="dictionary-list__item">
                    <div class="dictionary-list__title">{{__('Сокращенное наименование')}}:</div>
                    <div class="dictionary-list__value">{{($page->{___('text_4')})}}</div>
                </li>
                @endif
                @if ($page->{___('text_5')})
                <li class="dictionary-list__item">
                    <div class="dictionary-list__title">{{__('Наименования на английском языке')}}:</div>
                    <div class="dictionary-list__value">{{($page->{___('text_5')})}}</div>
                </li>
                @endif
                @if ($page->{___('text_6')})
                <li class="dictionary-list__item">
                    <div class="dictionary-list__title">{{__('Ведомственная принадлежность')}}:</div>
                    <div class="dictionary-list__value">{{($page->{___('text_6')})}}</div>
                </li>
                @endif
            </ul>
            @if ($page->{___('text')})
            <p class="page_about__text">
                {!! ($page->{___('text')}) ?? '' !!}
            </p>
            @endif
            
            @if (!$files_links->isEmpty())
                <ul class="attachments-list clear-list">
                    <div class="attachments-list__container">
                        @foreach ($files_links as $files_link_name => $files_link_array)
                            <li class="attachments-list__item">
                                <span class="attachments-list__text">{{$files_link_name}} -</span>
                                @foreach ($files_link_array as $i => $files_link)
                                    <a href="{{asset($files_link['path'])}}" download>{{$files_link['name']}}</a>@if($i!=(sizeof($files_link_array)-1)),@endif
                                @endforeach 
                            </li>
                        @endforeach
                    </div>
                </ul>
            @endif
            <br>    
            <a href="/o-ggi-istoriia" class="page_contacts__eform button button_with_blue_shadow">{{__('История')}}</a>

        </div>
    </div>
@endsection