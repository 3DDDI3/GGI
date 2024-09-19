@extends('layouts.default')
@section('content')
    <div class="page page_news">
        <div class="page__container page_news__container container">
            {!! \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('page', $page) !!}
            
            <div class="page_news__head _flex _space_between">
                <h1 class="page_news__title page-title">{{($page->{___('name')})}}</h1>
                <ul class="page_news__years-list clear-list _flex">
                    @foreach ($years as $year_item)
                        <li class="page_news__year">
                            <a href="{{route('news.index').'?y='.$year_item}}" class="page_news__year-link @if ($year_item==$year) page_news__year-link_active @endif">{{$year_item}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            @if (!$news->isEmpty())
                <ul class="arrows-list news-list board-news page-news__list clear-list">
                    @foreach ($news as $news_item)
                        @if ($news_item->news && $news_item->{___('name')})
                            <li class="arrows-list__item news-list__item">
                                <div class="arrows-list__container news-list__container">
                                    <div class="news-list__head board-news__head _flex _space_between">
                                        <div class="news-list__date board-news__date">
                                            <span class="board-news__day">{{date('d/m', $news_item->news->date ?? null) }}</span>
                                            <span class="board-news__year">{{date('Y', $news_item->news->date ?? null) }}</span>
                                        </div>
                                        <div class="news-list__arrow board-news__arrow">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="56" height="12" viewBox="0 0 56 12" fill="none">
                                                <g clip-path="url(#clip0_128_16726)">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M47.9508 4.55334V-0.315796L56.3403 5.94423L47.9508 12.2043V7.33547L0.410156 7.33547L0.410156 4.55334L47.9508 4.55334Z" fill="#00ADEF"/>
                                                </g>
                                                <defs>
                                                <clipPath id="clip0_128_16726">
                                                    <rect width="56" height="12" fill="white"/>
                                                </clipPath>
                                                </defs>
                                            </svg>
                                        </div>
                                    </div>
                                    <a href="{{route('news.single', ['link'=> $news_item->link])}}" class="news-list__title _without_underline">{{$news_item->{___('name')} ?? ''}}</a>
                                    @if ($news_item->news->{___('preview_text')})
                                        <p class="news-list__text">{{($news_item->news->{___('preview_text')}) ?? ''}}</p>
                                    @endif
                                </div>
                            </li>
                        @endif
                    @endforeach 
                </ul>
            @endif
        </div>
    </div>
@endsection