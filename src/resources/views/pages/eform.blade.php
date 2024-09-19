@extends('layouts.default')
@section('content')
    <div class="page page_eform">
        <div class="page__container container">

            {!! \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('page', $page) !!}


            <h1 class="page__title page-title">{{ $page->{___('name')} }}</h1>

            <div class="page__text">
                {!! $page->{___('text')} !!}
            </div>
            @if ($page->{___('text_2')})
                <div class="page__text page__text_2">
                    {!! $page->{___('text_2')} !!}
                </div>
            @endif
            @if (!$page->files->isEmpty())
                <div class="page__links">
                    @foreach ($files_links as $file_link)
                        <br />
                        <br />
                        <a href="{{ asset('storage/' . $file_link['path']) }}" class="page__link"
                            download>{{ $file_link['name'] }}</a>
                    @endforeach
                </div>
            @endif











            @if ($errors->any())
            <div class="alert alert-danger">
               {{__('ошибка валидации')}}
               {{-- <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul> --}}
            </div>
         @endif


            <div class="auth ">
                <div class="auth__container">
                    <div class="auth__tab-box">
                        @if ($data)
                            {{__('Заявка отправлена')}}
                        @else
                            <form class="auth__form auth__form_registration validate-this" action="" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row-2 row-gap-custom">
                                    <div class="col">
                                        <div class="page-title_30">{{__('Данные')}}</div>
                                        
                                        <div class="auth__block">
                                            <input type="text" class="auth__input input" placeholder="{{__('Фамилия')}}: *" required
                                                name="name1" >
                                        </div>
                                        <div class="auth__block">
                                            <input type="text" class="auth__input input" placeholder="{{__('Имя')}}: *" required
                                                name="name2" >
                                        </div>
                                        <div class="auth__block">
                                            <input type="text" class="auth__input input" placeholder="{{__('Отчество')}}:"
                                                name="name3">
                                        </div>
                                        <div class="auth__block">
                                            <input type="email" class="auth__input input" placeholder="E-mail"
                                                name="email">
                                        </div>
                                        <div class="auth__block">
                                            <input type="text" class="auth__input input" placeholder="{{__('Организация')}}:"
                                                name="organisation">
                                        </div>
                                        <div class="auth__block">
                                            <input type="text" class="auth__input input" placeholder="{{__('Должность')}}:"
                                                name="position">
                                        </div>
                                        <div class="auth__block">
                                            <input id="eform-file" type="file" class="hidden" placeholder=""
                                                name="file">

                                            <span>{{__('Файл')}}:</span>
                                            <label for="eform-file" class="button button_light-gray ">{{__('Выберите файл')}}</label>

                                            <div class="auth__notice">{{__('Вы можете приложить электронный файл с информацией к вашему обращению')}}.
                                                {{__('Максимальный размер файла')}}: 5 {{__('МБ')}}.
                                                {{__('Разрешённые типы файлов')}}: gif jpg jpeg png txt pdf doc docx rar zip.</div>
                                        </div>

                                    </div>
                                    <div class="col flex-col">
                                        <div class="page-title_30">{{__('Почтовый адрес')}}</div>
                                        <div class="auth__block">
                                            <input type="number" class="auth__input input" placeholder="{{__('Индекс')}}: *"
                                                name="zipcode" required>
                                        </div>
                                        <div class="auth__block">
                                            <input type="text" class="auth__input input"
                                                placeholder="{{__('Область')}}, {{__('республика')}}: *" name="region" required>
                                        </div>
                                        <div class="auth__block">
                                            <input type="text" class="auth__input input" placeholder="{{__('Город')}}: *"
                                                name="city" required>
                                        </div>
                                        <div class="auth__block">
                                            <input type="text" class="auth__input input" placeholder="{{__('Адрес')}}: *"
                                                name="address" required>
                                        </div>
                                        <div class="auth__block filler flex-col">
                                            <textarea style="resize: none; " class="auth__input input filler" name="text" id=""
                                                placeholder="Текст обращения: *" required></textarea>
                                            <div class="auth__notice"><span style="color: red">*</span> {{__('Поле обязательное для заполнения')}}</div>
                                        </div>

                                        <div class="auth__block">

                                            <div class="politic">
                                                <input type="checkbox" class="checkbox" id="bf2" name=""
                                                    value="yes" required="" />
                                                <label for="bf2" class="politic-text">
                                                    <p>
                                                        {{__('Нажимая на кнопку "Отправить", я даю согласие на')}} <a class="color-active" target="_blank">{{__('обработку')}}</a> {{__('персональных данных')}}
                                                    </p>
                                                </label>
                                            </div>


                                        </div>

                                    </div>
                                </div>
                                <div class="row-2 row-gap-custom">
                                    <div class="auth__block col">
                                        <div class="auth__captcha _flex">
                                            <img src="/images/captcha.jpg" alt="captcha">
                                            <input type="text" class="auth__input input" placeholder="{{__('Введите символы')}}"
                                                required>
                                        </div>
                                        <div class="auth__notice">{{__('Введите символы показанные на картинке')}}.</div>
                                    </div>
                                    <div class="auth__block col">
                                        <button type="submit" class="auth__submit button">{{ __('Отправить') }}</button>
                                    </div>
                                </div>
                            </form>
                        @endif

                    </div>
                </div>
            </div>
















        </div>
    @endsection
