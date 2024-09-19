@extends('layouts.default')
@section('content')
    <div class="page page_administration">
        <div class="page__container page_administration__container container container_1400">

            {!! \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('page', $page) !!}

            <h1 class="page_administration__title page-title">{{($page->{___('name')})}}</h1>
            <div class="page__text page_administration__text">
                {!! $page->{___('text')} !!}
            </div>
            <div class="page_administration__cards-grid card__items-grid">
                @foreach ($administration as $administrator)
                    @if ($administrator->{___('name')})
                    <div class="page_administration__card card">
                        <div class="card__container">
                            <div class="card__grid">
                                <div class="card__top">
                                    
                                    @if ($administrator->administration->{___('position')})
                                        <div class="card__type">{{$administrator->administration->{___('position')} ?? ''}}</div>
                                    @endif
                                    <div class="card__title">{!! nl2br($administrator->{___('name')} ?? '') !!}</div>
                                    @if ($administrator->administration->{___('degree')})
                                        <div class="card__subtitle">{{$administrator->administration->{___('degree')} ?? ''}}</div>
                                    @endif
                                </div>
                                <div class="card__bottom">
                                    @if ($administrator->administration->phones)
                                    <div class="card__dictionary">
                                        <div class="card__dictionary-title">{{__('Телефон')}}</div>
                                        <div class="card__dictionary-value card__dictionary-value_phone">{{$administrator->administration->phones}}</div>
                                    </div>
                                    @endif
                                    @if ($administrator->administration->phones_adm)
                                    <div class="card__dictionary">
                                        <div class="card__dictionary-title">{{__('Телефон приёмной')}}</div>
                                        <div class="card__dictionary-value card__dictionary-value_phone">{{$administrator->administration->phones_adm}}</div>
                                    </div>
                                    @endif
                                    @if ($administrator->administration->phones_fax)
                                    <div class="card__dictionary">
                                        <div class="card__dictionary-title">{{__('Факс')}}:</div>
                                        <div class="card__dictionary-value card__dictionary-value_phone">{{$administrator->administration->phones_fax}}</div>
                                    </div>
                                    @endif
                                    @if ($administrator->administration->email)
                                    <div class="card__dictionary">
                                        <div class="card__dictionary-title">E-mail:</div>
                                        <div class="card__dictionary-value card__dictionary-value_email">{{$administrator->administration->email}}</div>                               
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>

        </div>
    </div>
@endsection