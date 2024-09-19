@extends('admin.app')
@section('content')
        <h1>{{$title[0]}}</h1>

        @include('admin.includes.search')
        @include('admin.includes.add')

        @if ($objects)

            @include('admin.includes.sortable.info')
            <div class="sortable_list" >
            @foreach($objects as $object)
                <div class="list_item">
                    <div class="list_item-info">
                        <h4>{{$object->title}}</h4>
                        @if ($object->image)
                            @include('admin.includes.image', ['path' => '/storage/'.$object->image])
                        @endif
                    </div>
                    <div class="list_item-actions">
                        @include('admin.includes.sortable.rating')
                        @include('admin.includes.actions.show')
                        @include('admin.includes.actions.edit')
                        @include('admin.includes.actions.delete')
                        @include('admin.includes.sortable.rating')
                    </div>
                </div>
            @endforeach
            </div>

        @endif

@endsection
