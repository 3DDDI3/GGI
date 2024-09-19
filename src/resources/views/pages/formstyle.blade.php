@extends('layouts.default')
@section('content')
    <div class="page">
        <div class="page__container container">

            {!! \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('page', $page) !!}

            <h1 class="page__title page-title">{{ $page->{___('name')} }}</h1>
            <div class="page__text">
                {!! $page->{___('text')} !!}
            </div>
            @if ($page->{___('text_2')})
                <div class="page__text page__text_2">
                    {!! $page->{___('text_2')} !!}
                </div>
            @endif
            @if (!$page->files->isEmpty())
                <div class="page__links">
                    @foreach ($files_links as $file_link)
                        <br />
                        <br />
                        <a href="{{ asset('storage/' . $file_link['path']) }}" class="page__link"
                            download>{{ $file_link['name'] }}</a>
                    @endforeach
                </div>
            @endif




            @if ($form_style)
                <div class="row-4">
                    @foreach ($form_style as $section)
                        <div class="col">
                            <div class="style-box">
                                <div class="style-box__preview">
                                    <img src="{{ asset('storage/' . $section[0]->path) }}" alt="">
                                </div>

                                <div class="style-box__download-section">
                                    <div class="text">
                                        {{__('Скачать')}}:
                                    </div>

                                    @foreach ($section as $file)
                                        @if (pathinfo($file->path)['extension'] === 'png')
                                            <a target="_blank" href="{{ asset('storage/' . $file->path) }}">
                                                <img class="download-section__btn"
                                                    src="{{ asset('/images/svg/icon-png.svg') }}" alt="">
                                            </a>
                                        @elseif(pathinfo($file->path)['extension'] === 'jpg')
                                            <a target="_blank" href="{{ asset('storage/' . $file->path) }}">
                                                <img class="download-section__btn"
                                                    src="{{ asset('/images/svg/icon-jpg.svg') }}" alt="">
                                            </a>
                                        @else
                                            <a target="_blank" href="{{ asset('storage/' . $file->path) }}">
                                                {{__('скачать')}}
                                            </a>
                                        @endif
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
