@extends('layouts.default')
@section('content')
    <div class="page page_service">
        <div class="page__container page_service__container container">

            {!! \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('publications2', $publication, $page) !!}

            <h1 class="page_service__title page-title">{{($publication->{___('name')})}}</h1>
            <div class="page_service__text">
                {!! $publication->{___('text')} ?? '' !!}
            </div>

        </div>
    </div>
@endsection