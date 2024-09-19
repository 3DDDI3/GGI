@extends('layouts.default')
@section('content')
    <div class="page page_publications">
        <div class="page__container page_publications__container container">
            {!! \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('page', $page) !!}
            <h1 class="page-title page__title">{{($page->{___('name')})}}</h1>
            <ul class="page_publications__list clear-list">
                @foreach ($publications as $publication)
                    @if ($publication && $publication->{___('name')})
                        <li class="page_publications__publication publication">
                            <div class="publication__container">
                                <div class="publication__grid _flex">
                                    <div class="publication__image">
                                        <picture class="publication__picture">
                                            <img src="{{asset('storage/'.$publication->image)}}" alt="{{$publication->{___('name')} ?? ''}}" class="publication__img">
                                        </picture>
                                    </div>
                                    <div class="publication__content">
                                        <div class="publication__title">{{($publication->{___('name')})}}</div>
                                        <a href="{{asset('storage'.$publication->path)}}" class="publication__download _with_underline" download>{{__('Скачать')}}</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
            <div class="page__text page_publications__text">
                {!! $page->{___('text')} !!}
            </div>

        </div>
    </div>
@endsection