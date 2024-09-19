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




        </div>
    </div>
@endsection
