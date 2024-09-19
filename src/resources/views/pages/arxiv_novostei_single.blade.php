@extends('layouts.default')
@section('content')
    <div class="page page_service">
        <div class="page__container page_service__container container">

            {!! \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('news', $news, $page) !!}
            <h1 class="page_service__title page-title">{{ $news->{___('name')} }}</h1>
            @if ($galleryIsset = !$news->news->gallery->isEmpty())
                <div class="row-2">
                    <div class="col">
                        <div class="page_service__text">
                            {!! $news->news->{___('preview_text')} ?? '' !!}
                        </div>
                    </div>
                    <div class="col">
                        @include('includes.gallery', [
                            'class' => 'page_course__gallery',
                            'images' => $news->news->gallery->map(
                                fn($a) => ['src' => asset('storage/' . $a->original), 'alt' => $a->alt]),
                        ])
                    </div>
                </div>
            @endif
            <br>
            <div class="page_service__text">
                {!! $news->{___('text')} ?? '' !!}
            </div>
        </div>
    </div>
@endsection
