@extends('layouts.default')
@section('content')
    <div class="page page_publications2">
        <div class="page__container page_publications2__container container">
            {!! \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('page', $page) !!}
            <h1 class="page-title page-title_with_decoration_dots">{{($page->{___('name')})}}</h1>
            <div class="page_publications2__text page__text">
                {!! $page->{___('text')} !!}
            </div>
            <ul class="page_publications2__list clear-list">
                @foreach ($publications as $publication)
                    <li class="page_publications2__item _flex">
                        <div class="page_publications2__year">{{$publication->created_at->format('Y')}}</div>
                        <a href="{{route('publications2.single', ['publication' => $publication->link])}}" class="page_publications2__link">{{($publication->{___('name')})}}</a>
                    </li>
                @endforeach
            </ul>
            <div class="page_publications2__text page__text">
                {!! $page->{___('text_2')} !!}
            </div>

        </div>
    </div>
@endsection