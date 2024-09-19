@extends('admin.app')
@section('content')
    <h1>{{$title[0]}}</h1>

    <div class="filter"></div>

    <table class="request-table table_dark">
        <thead>
            <th>№</th>
            <th>Время</th>
            <th>Действие</th>
            <th>Пользователь</th>
            <th>Раздел</th>
            <th>ID элемента</th>
            <th>Название элемента</th>
        </thead>
        <tbody>
            @foreach ($objects as $object)
                <tr>
                    <td>{{$object->id}}</td>
                    <td>{{$object->created_at}}</td>
                    <td>{{$object->actions[$object->action]}}</td>
                    <td><a href="{{route('admin.users.users.edit', ['id' => $object->user->id])}}">{{$object->user->name}}</a></td>
                    <td><a href="{{route('admin.'.$object->path.'.index')}}">{{\App\Helpers\Admin\Helper::getSectionNameByPath($object->path)}}</a></td>
                    <td>{{$object->item_id}}</td>
                    <td>
                        @if ($object->item)
                            {{
                                $object->item->name
                                ?? $object->item->title
                                ?? $object->item->code
                                ?? $object->item->ip
                                ?? $object->item->youtube_url
                            }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $objects->links('pagination.default') }}

@endsection

