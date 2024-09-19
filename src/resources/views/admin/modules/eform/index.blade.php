@extends('admin.app')
@section('content')
    <h1>{{ $title[0] }}</h1>
    <table class="request-table table_dark">

        <thead>
            <tr>
                <th>№</th>
                <th>Дата отправки</th>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Отчество</th>
                <th>Email</th>
                <th>Организация</th>
                <th>Должност</th>

                <th>Индекс</th>
                <th>Область</th>
                <th>Город</th>
                <th>Адресс</th>
                <th>Текст</th>
                <th>Файл</th>


                <th></th>
            </tr>
        </thead>

        <tbody>

            @foreach ($objects as $object)
                <tr>
                    <td>{{ $object->id }}</td>
                    <td>{{ $object->created_at }}</td>
                    <td>{{ $object->name1 ?? '' }}</td>
                    <td>{{ $object->name2 ?? '' }}</td>
                    <td>{{ $object->name3 ?? '' }}</td>
                    <td>{{ $object->email ?? '' }}</td>
                    <td>{{ $object->organisation ?? '' }}</td>
                    <td>{{ $object->position ?? '' }}</td>

                    <td>{{ $object->zipcode ?? '' }}</td>
                    <td>{{ $object->region ?? '' }}</td>
                    <td>{{ $object->city ?? '' }}</td>
                    <td>{{ $object->address ?? '' }}</td>
                    <td class="text-container">
                        <div class="text-box">{{ $object->text ?? '' }}</div>
                    </td>
                    <td>
                        @if ($object->file)
                            <a href="{{ asset('storage/' . $object->file) }}">файл</a>
                        @else
                            {{ $object->file ? '' : 'нет' }}
                        @endif

                    </td>
                    <td><a href="?delete={{ $object->id }}" class="admin_delete" title="Удалить"></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
