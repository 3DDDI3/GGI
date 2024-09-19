@extends('layouts.default')
@section('content')
    <div class="page page_structure">
        <div class="page__container page_service__structure container">
            {!! \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('page', $page) !!}
            <div class="page_structure__grid _flex">
                <h1 class="page_structure__title page-title">{{($page->{___('name')})}}</h1>
                @if ($page->file)
                    <a href="{{asset('storage/'.$page->file)}}" class="page_structure__docs-button docs-button">
                        <span class="docs-button__primary">
                            @include('includes.icons.docs', ['type'=>'word'])
                        </span>
                        <span class="docs-button__secondary">
                            {{basename(asset('storage/'.$page->file))}}
                        </span>
                    </a>
                @endif
            </div>
            <ul class="arrows-list page_structure__list clear-list">
                @php $html=''; \App\Models\Content::showDepartments($departments, $html) @endphp
                {!! $html !!}

            </ul>

        </div>
    </div>
@endsection