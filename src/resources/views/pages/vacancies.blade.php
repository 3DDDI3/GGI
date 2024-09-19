@extends('layouts.default')
@section('content')
<div class="page page_vacancies">
    <div class="page__container page_vacancies__container container">
        {!! \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('page', $page) !!}

        <h1 class="page_vacancies__title page-title">{{$page->name}}</h1>
        <div class="page_vacancies__accordion accordion js-accordion arrows-list">
            @if (!$vacancies->isEmpty())
                @foreach ($vacancies as $vacancy)
                    @if ($vacancy && $vacancy->{___('name')})
                        <x-Accordion title="{{($vacancy->{___('name')})}}">
                            {!! trait_list($vacancy->{___('text')}) !!}
                        </x-Accordion>
                    @endif
                @endforeach 
            @endif
        </div>
        <div class="page__text page_vacancies__text">
            {!! ($page->{___('text')}) !!}
        </div>
        @if (!$files_links->isEmpty())
            <div class="page__block page__block_links">
                @foreach ($files_links as $i => $file_link)
                <a href="{{asset('storage/'.$file_link['path'])}}" download>{{$file_link[___('name')]}}</a>
                @if ($i != (sizeof($files_links)-1))
                <br/><br/>
                @endif
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection