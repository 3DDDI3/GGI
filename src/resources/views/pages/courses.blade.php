@extends('layouts.default')
@section('content')
    <div class="page page_courses">
        <div class="page__container page_courses__container container">

            {!! \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('page', $page) !!}

            <h1 class="page-title page-title_with_decoration_dots">{{($page->{___('name')})}}</h1>
            <ul class="arrows-list page_courses__arrow-list clear-list">
                @if (!$courses->isEmpty())
                    @foreach ($courses as $course)
                    <li class="arrows-list__item">
                        <div class="arrows-list__container">
                            <div class="arrows-list__grid _flex _space_between">
                                <a href="{{route('courses.single', ['link' => $course->link])}}" class="arrows-list__title">{{($course->{___('name')}) ?? ''}}</a>
                                <div class="arrows-list__arrow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="56" height="12" viewBox="0 0 56 12" fill="none">
                                        <g clip-path="url(#clip0_128_16726)">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M47.9508 4.55334V-0.315796L56.3403 5.94423L47.9508 12.2043V7.33547L0.410156 7.33547L0.410156 4.55334L47.9508 4.55334Z" fill="#00ADEF"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0_128_16726">
                                            <rect width="56" height="12" fill="white"/>
                                        </clipPath>
                                        </defs>
                                    </svg>
                                    </div> 
                            </div>
                        </div>
                    </li>
                    @endforeach
                @endif
            </ul>
            <div class="page__text">
                {!! ($page->{___('text')}) !!}
            </div>
            @if (!$files_links->isEmpty())
                <div class="page_courses__files">
                    <div class="page_courses__files-title page-title page-title_36">{{__('Файлы для ознакомления')}}:</div>
                    <ul class="page_courses__files-list">
                        @foreach ($files_links as $file_link)
                            <li class="page_courses__files-list-item"><a href="{{asset($file_link['path'])}}" download>{{$file_link['name']}}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
    </div>
@endsection