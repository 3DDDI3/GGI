@extends('admin.app')
@section('content')
        @include('admin.includes.h1')
        <div class="admin_edit_block">
            @include('admin.includes.back')
            <form  method="post" enctype="multipart/form-data" class="admin_edit-form">
                @csrf
                @include('admin.includes.filebox', ['name' => 'files', 'item_type' => 'form_style', 'object' => $object])
                @include('admin.includes.errors')
                @include('admin.includes.submit')
            </form>
        </div>
@endsection