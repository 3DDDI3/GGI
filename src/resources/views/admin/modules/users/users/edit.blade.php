@extends('admin.app')
@section('content')

        @include('admin.includes.h1')

        <div class="admin_edit_block">

            <div class="admin_edit-links">
                <a href="{{route('admin.users.users.index')}}">Назад к списку</a>
            </div>

            <form  method="post" class="admin_edit-form" enctype="multipart/form-data">

                @csrf

                <fieldset>
                    <legend>Класс и тип пользователя</legend>

                    @include('admin.includes.select', ['label'=>'Класс пользователя:', 'name'=>'class', 'value'=>$object->class ?? 3, 'select'=>$select_user_class])

                </fieldset>

                <fieldset>
                    <legend>Основные данные</legend>

                    <div class="column-items column-items2">
                        <div class="column-item">
                            @include('admin.includes.input', ['label' => 'Email:', 'name' => 'email', 'value' => $object->email ?? '', 'required' => 'required'])
                            @if (session('message_email'))
                                <div class="error">{!! session('message_email') !!}</div>
                            @endif
                        </div>
                        <div class="column-item">
                            <div class="input_block">
                                <span>{{ !empty($object->id) ? 'Новый пароль' : 'Пароль' }}:</span>
                                <input type="password" name="password" value="" autocomplete="new-password">
                            </div>
                        </div>
                    </div>

                    {{-- <div class="input_block">
                        <span>Телефон:</span>
                        <div class="input_block_row">
                            <select class="select-phone-code" name="phone_code">
                                @foreach ($select_phone_code AS $code)
                                    <option value="{{ $code->name }}" {{ $code->name == $object->phone_code ? 'selected' : '' }}>{{ $code->name }}</option>
                                @endforeach
                            </select>
                            <input class="select-phone" type="text" name="phone" value="{{ $object->phone ?? '' }}" maxlength="191">
                        </div>
                    </div>
                    @if (session('message_phone'))
                        <div class="error">{!! session('message_phone') !!}</div>
                    @endif --}}

                </fieldset>

                <fieldset>
                    <legend>Профиль</legend>

                    {{-- {!! \App\Helpers\GenerateForm::makeImage('Аватар', 'image' , $object , '/storage/'.$object->image) !!} --}}

                    <div class="column-items column-items3 column-items-margin">
                        {{-- <div class="column-item">
                            @include('admin.includes.input', ['label' => 'Фамилия:', 'name' => 'lastname', 'value' => $object->lastname ?? ''])
                        </div> --}}
                        <div class="column-item">
                            @include('admin.includes.input', ['label' => 'Имя:', 'name' => 'name', 'value' => $object->name ?? ''])
                        </div>
                        {{-- <div class="column-item">
                            @include('admin.includes.input', ['label' => 'Отчество:', 'name' => 'middlename', 'value' => $object->middlename ?? ''])
                        </div> --}}
                    </div>
                </fieldset>

                {{-- <fieldset>
                    <legend>Карта и тип клиента</legend>

                    @include('admin.includes.select', ['label'=>'Карта клиента:', 'name'=>'client_card', 'value'=>$object->client_card ?? 3, 'select'=>$select_client_card])

                    @include('admin.includes.select', ['label'=>'Тип клиента:', 'name'=>'client_type', 'value'=>$object->client_type ?? 3, 'select'=>$select_client_type])
                </fieldset> --}}

                {{-- <fieldset>
                    <legend>Бонусы</legend>
                    <div class="bonus-accrual js-bonus-accrual input_block">
                        <div class="bonus-accrual__grid js-bonus-accrual__grid" style="margin-bottom: 10px;">
                            <input type="text" class="js-bonus-accrual__input" placeholder="Начислить бонусов" style="max-width: 70%">
                            <button type="button" class="js-bonus-accrual__button" data-id="{{$object->id}}" data-type="custom_accrual">Начислить</button>
                        </div>
                        <strong>У данного пользователя <span>{{$object->bonuses_count}}</span> бонусов</strong>
                    </div>
                </fieldset> --}}

                @include('admin.includes.submit')

            </form>

        </div>

@endsection
