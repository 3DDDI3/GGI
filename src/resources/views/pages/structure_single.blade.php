@extends('layouts.default')
@section('content')
    <div class="page page_service">
        <div class="page__container page_service__container container">
            <div class="breadcrumbs">
                <div class="breadcrumbs__container">
                    {!! \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('structure', $department, $page) !!}
                </div>
            </div>
            <h1 class="page_service__title page-title">{{($department->{___('name')})}}</h1>
            <div class="page_service__text">
                {!! ($department->{___('text')}) !!}
            </div>

        </div>
    </div>
@endsection