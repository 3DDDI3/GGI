@extends('admin.app')
@section('content')

    <h1>{{ $title[0] }}</h1>

    @include('admin.includes.search', ['search_label' => 'Введите Email, Телефон или ФИО'])

    @include('admin.includes.add')

    @include('admin.includes.paginate.total')

    @if ($objects)
        <div class="sortable_list_off">
            @foreach($objects as $object)
                <div class="list_item">
                    <div class="list_item-info">
                        @if (!empty($object->email))
                            <h4>{{ $object->email }}</h4>
                        @endif
                        <h4 class="list-second">{{ $object->phone }}</h4>
                        <i>{{ $object->class_name ?? '' }}</i>

                        @if (!empty($object->client_card_info))
                            <span class="list-item-small">Карта: {!! \App\Helpers\Admin\Helper::card_format($object->client_card_info->name) !!}</span>
                        @endif

                        @if (!empty($object->client_type_info))
                            <span class="list-item-small">Тип клиента: {!! $object->client_type_info->name !!}</span>
                        @endif

                    </div>
                    <div class="list_item-actions">
                        @include('admin.includes.actions.edit')
                        @if ($object->email != 'admin')
                            @include('admin.includes.actions.delete')
                        @endif
                    </div>
                </div>
            @endforeach

            @include('admin.includes.not_found')
        </div>
        {{ $objects->links('pagination.default') }}
    @endif

@endsection
