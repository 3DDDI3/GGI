@extends('layouts.default')
@section('content')
    <div class="page page_council">
        <div class="page__container container">
            {!! \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('page', $page) !!}
            <h1 class="page__title page-title">{{ $page->{___('name')} }}</h1>
            <div class="accordion js-accordion arrows-list">
                @foreach ($council as $section)
                    <x-Accordion title="{{ $section->{___('name')} ?? '' }}" title_2="">
                        {!! $section->{___('text')} !!}
                    </x-Accordion>
                @endforeach
            </div>
        </div>
    @endsection
