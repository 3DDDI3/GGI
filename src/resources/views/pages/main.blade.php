@extends('layouts.landing')
@section('content')
<div class="page page_main">
    @include('includes.main_page.main_screen')
    @include('includes.main_page.banner_section')
    @include('includes.main_page.board_section')
    @include('includes.main_page.about_section')
    @include('includes.main_page.map_section')
</div>
@endsection