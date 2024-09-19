@extends('layouts.default')
@section('content')
    <div class="page page_magazine">
        <div class="page__container container">
            {!! \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('page', $page) !!}

            <h1 class="page__title page-title page_magazine__title">{{ $page->{___('name')} }}</h1>
            
            @if (!$departments->isEmpty())
                <div class="page_magazine__grid _flex">
                    <div class="page_magazine__primary">
                        <div class="page_magazine__sidebar js-page_magazine__sidebar">
                            <ul class="page_magazine__trait-list trait-list clear-list">
                                @foreach ($departments as $department)
                                    <li class="trait-list__item js-page-sidebar-button" data-i={{$department->id}}><a href="#magazine_dep{{$department->id}}"><b>{{($department->{___('name')})}}</b></a></li>
                                @endforeach 
                            </ul>
                        </div>
                    </div>
                    <div class="page_magazine__secondary">
                        @foreach ($departments as $department)
                            <div class="page_magazine__department js-page_magazine__department" data-i="{{$department->id}}" id="magazine_dep{{$department->id}}">
                                <div class="page_magazine__title title title_30">{{($department->{___('name')})}}</div>
                                {!! $department->{___('text')} !!}
                            </div>
                            <hr>
                        @endforeach 
                    </div>
                </div>
            @endif


        </div>
    </div>
@endsection
