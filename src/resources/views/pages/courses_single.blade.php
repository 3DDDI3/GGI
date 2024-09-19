@extends('layouts.default')
@section('content')
    <div class="page page_course">
        <div class="page__container page_course__container container container_1400">
            {!! \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('courses', $course, $page) !!}
            <h1 class="page_course__title page-title">{{($course->{___('name')})}}</h1>
            <div class="page_course__grid _flex _space_between">
                <div class="page__text page_course__content">
                    {!! ($course->{___('text')}) !!}
                    <div class="page_course__boxed-text boxed-text">
                        {!! ($course->courses->{___('text_2')}) !!}
                    </div>
                    <div class="page_course__buttons _flex _align_center">
                        {{-- <a href="#" class="button page_course__button">{{__('Заявка на участие')}}</a> --}}
                        {{-- <a href="#" class="page_course__link _with_underline">{{__('Расписание занятий')}}</a> --}}
                    </div>
                </div>
                @if (!$course->courses->gallery->isEmpty())
                    @include('includes.gallery', ['class' => 'page_course__gallery', 'images' => $course->courses->gallery->map(fn($a)=>['src'=>asset('storage/'.$a->original),'alt'=>$a->alt])])
                @endif
            </div>

        </div>
    </div>
@endsection