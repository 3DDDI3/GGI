@extends('layouts.default')
@section('content')
<div class="page page_branches">
    <div class="page__container page_branches__container container">

        {!! \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('page', $page) !!}

        <h1 class="page__title page-title">{{($page->{___('name')})}}</h1>

        <div class="search" id="search">
            <div class="search__center">
                <div class="search__container">
                    <form action="/search" method="post" class="search__form">
                        @csrf
                        <div class="search-box search__search-box">
                            <input name="search" type="search" class="search__input" id="search-input" placeholder="&nbsp;" autocomplete="off" value="{{ $query }}">
                            <label for="search-input" class="search__placeholder">Поиск</label>
                            <button type="submit" class="search__button">Найти</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="search-results" id="search-results">
            <div class="container search-results__center">
                <div class="search-results__container"></div>
            </div>
        </div>
    </div>
</div>

@endsection
