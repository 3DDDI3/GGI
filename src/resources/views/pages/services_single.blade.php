@extends('layouts.default')
@section('content')
    <div class="page page_service">
        <div class="page__container page_service__container container">

            <div class="breadcrumbs">
                <div class="breadcrumbs__container">
                    {!! \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('page', $service, $page) !!}
                </div>
            </div>
            <h1 class="page_service__title page-title">{{($service->{___('name')})}}</h1>
            <div class="page_service__text">
                {!! ($service->{___('text')}) !!}
            </div>

        </div>
    </div>
@endsection