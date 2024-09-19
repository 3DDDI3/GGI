@extends('layouts.default')
@section('content')
<div class="page page_staff">
    <div class="page__container page_staff__container container">
        {!! \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('page', $page) !!}
        <div class="page_staff__head _flex">
            <h1 class="page-title page__title page_staff__title">{{($page->{___('name')})}}</h1>
            {{-- <button class="link page_staff__unable-filter">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                    <g clip-path="url(#clip0_64_13592)">
                      <path d="M7.23658 8.97822C7.43596 9.19519 7.54543 9.47863 7.54543 9.77185V18.4119C7.54543 18.9319 8.17291 19.1958 8.54431 18.8302L10.9545 16.0681C11.2771 15.6811 11.455 15.4895 11.455 15.1064V9.7738C11.455 9.48059 11.5664 9.19715 11.7638 8.98015L18.6797 1.47584C19.1977 0.912873 18.799 0 18.0327 0H0.967641C0.201375 0 -0.199351 0.910919 0.320615 1.47584L7.23658 8.97822Z" fill="#29B3FF"/>
                    </g>
                    <defs>
                      <clipPath id="clip0_64_13592">
                        <rect width="19" height="19" fill="white"/>
                      </clipPath>
                    </defs>
                  </svg>
                  <span>
                    {{__('Скрыть фильтры')}}
                  </span>
            </button> --}}
        </div>
        <div class="page_staff__filter filter">
            <div class="filter__container">
              <form class="filter__form">
                <div class="filter__grid _flex">
                  <select class="filter__select select" name="subdivision">
                      <option value="0">{{__('Подразделение')}}</option>
                      @if (!$subdivisions->isEmpty())
                        @foreach($subdivisions as $subdivision)
                          @if ($subdivision && $subdivision->{___('name')})
                            <option value="{{$subdivision->id}}">{{($subdivision->{___('name')})}}</option>
                          @endif
                        @endforeach
                      @endif
                  </select>
                  <select class="filter__select select" name="laboratory">
                    <option value="0">{{__('Лаборатория')}}</option>
                    @if (!$laboratories->isEmpty())
                      @foreach($laboratories as $laboratory)
                        @if ($laboratory && $laboratory->{___('name')})
                            <option value="{{$laboratory->id}}">{{($laboratory->{___('name')})}}</option>
                        @endif
                      @endforeach
                    @endif
                  </select>
                  <button type="submit" class="filter__button button button_with_blue_shadow">{{__('Показать')}}</button>
                </div>
              </form>
            </div>
        </div>
        @if (!$staff->isEmpty())
          <div class="page_staff__accordion accordion js-accordion arrows-list">
              @foreach ($staff as $employee)
                <x-Accordion title="{{$employee->{___('name')} ?? ''}}" title2="{{$employee->{___('position')} ?? ''}}">
                    <div class="page_staff__employee-head _flex">
                        <div class="page_staff__eployee-image">
                          @if ($employee->image)
                            <picture class="page_staff__employee-picture">
                              <img src="{{asset('storage/'.$employee->image)}}" alt="{{$employee->{___('name')} ?? ''}}" class="page_staff__employee-img">
                            </picture>
                          @endif
                         
                        </div>
                        <ul class="page_staff__dictionary-list dictionary-list clear-list">
                            <li class="dictionary-list__item dictionary-list__item_degree">
                              <div class="dictionary-list__title">{{__('Степень')}}:</div>
                              <div class="dictionary-list__value">{{($employee->{___('degree')} ?? '')}}</div>
                            </li>
                            @if ($employee->phone || $employee->email)
                              <li class="dictionary-list__item dictionary-list__item_contacts">
                                <div class="dictionary-list__title">{{__('Контакты')}}:</div>
                                <div class="dictionary-list__value">
                                    @if ($employee->phone)
                                      <div class="dictionary-list__phones_staff">
                                          {{($employee->phone)}}
                                      </div>
                                    @endif
                                    @if ($employee->email)
                                      <a href="mailto:{{$employee->email}}" class="dictionary-list__email_staff">
                                        {{$employee->email}}
                                      </a>
                                    @endif
                                </div>
                              </li>
                            @endif
                            @if ($employee->subdivision)
                              <li class="dictionary-list__item dictionary-list__item_subdivision">
                                <div class="dictionary-list__title">{{__('Подразделение')}}:</div>
                                <div class="dictionary-list__value dictionary-list__value_subdivision">
                                    {{($employee->subdivision->{___('name')}) ?? ''}}
                                </div>
                              </li>
                            @endif
                            @if ($employee->laboratory)
                              <li class="dictionary-list__item dictionary-list__item_laboratory">
                                <div class="dictionary-list__title">{{__('Лаборатория')}}:</div>
                                <div class="dictionary-list__value dictionary-list__value_laboratory">
                                    {{($employee->laboratory->{___('name')}) ?? ''}}
                                </div>
                              </li>
                            @endif
                        </ul>
                    </div>
                    @if ($employee->description)
                      <br>
                          <div>{!!$employee->description!!}</div>
                        @endif
                    @if ($employee->{___('text')})
                      <br/><br/>
                      {!! $employee->{___('text')} ?? '' !!}
                    @endif
                </x-Accordion>
              @endforeach 
          </div>
        @endif
    </div>
</div>
@endsection