@extends('admin.app')
@section('content')

        @include('admin.includes.h1')

        <div class="admin_edit_block">
            @include('admin.includes.back')

            <form  method="post" enctype="multipart/form-data" class="admin_edit-form">
                @csrf

                @include('admin.includes.input', ['label' => 'IP:', 'name' => 'ip', 'value' => $object->ip ?? '', 'required' => 'required'])

                @include('admin.includes.submit')
            </form>
        </div>

@endsection
