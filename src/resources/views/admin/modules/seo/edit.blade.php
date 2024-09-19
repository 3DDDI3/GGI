@extends('admin.app')
@section('content')

        @include('admin.includes.h1')

        <div class="admin_edit_block">

            @include('admin.includes.back')

            <form  method="post" enctype="multipart/form-data" class="admin_edit-form">

                @csrf

                <div class="input_block">
                    <span>Ссылка:</span>
                    <input type="text" name="url" value="{{$object->url ?? ''}}" required="">
                </div>

                <fieldset>
                    <legend>Meta</legend>
                    <div class="input_block">
                        <span>Title:</span>
                        <input type="text" name="title" value="{{$object->title ?? ''}}">
                    </div>
                    <div class="input_block">
                        <span>Description:</span>
                        <textarea type="text" name="description">{{$object->description ?? ''}}</textarea>
                    </div>
                    <div class="input_block">
                        <span>Keywords:</span>
                        <textarea type="text" name="keywords">{{$object->keywords ?? ''}}</textarea>
                    </div>
                    <div class="input_block">
                        <span>Canonical:</span>
                        <textarea type="text" name="canonical">{{$object->canonical ?? ''}}</textarea>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>OpenGraph</legend>
                    <div class="input_block">
                        <span>og:title:</span>
                        <input type="text" name="og_title" value="{{$object->og_title ?? ''}}">
                    </div>
                    <div class="input_block">
                        <span>og:description:</span>
                        <textarea type="text" name="og_description" >{{$object->og_description ?? ''}}</textarea>
                    </div>
                    <div class="input_block">
                        <span>og:url:</span>
                        <input type="text" name="og_url" value="{{$object->og_url ?? ''}}">
                    </div>
                </fieldset>

                <fieldset>
                    <legend>TwitterCard</legend>
                    <div class="input_block">
                        <span>twitter:title:</span>
                        <input type="text" name="twitter_title" value="{{$object->twitter_title ?? ''}}">
                    </div>
                    <div class="input_block">
                        <span>twitter:site:</span>
                        <textarea type="text" name="twitter_site" >{{$object->twitter_site ?? ''}}</textarea>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>JsonLd</legend>
                    <div class="input_block">
                        <span>jsonld:title:</span>
                        <input type="text" name="jsonld_title" value="{{$object->twitter_title ?? ''}}">
                    </div>
                    <div class="input_block">
                        <span>jsonld:description:</span>
                        <textarea type="text" name="jsonld_description" >{{$object->jsonld_description ?? ''}}</textarea>
                    </div>
                    <div class="input_block">
                        <span>jsonld:type:</span>
                        <textarea type="text" name="jsonld_type" >{{$object->jsonld_type ?? ''}}</textarea>
                    </div>
                </fieldset>

                @include('admin.includes.submit')

            </form>

        </div>


@endsection
