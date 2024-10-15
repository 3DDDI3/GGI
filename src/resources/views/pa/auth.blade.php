@extends('pa.main')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pa/normalize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/pa/auth.css') }}" />
@endsection

@section('main')
    <main>
        <section class="auth">
            <div class="auth__logo">
                <div class="auth__wrapp-img">
                    <img src="{{ asset('images/pa/logo-img-1.png') }}"
                        alt="Логотип Государственного гидрологического института" class="auth__img" />
                </div>
                <div class="auth__wrapp-title">
                    <h2 class="auth__title-logo">
                        Государственный гидрологический институт
                    </h2>
                    <p class="auth__desc">
                        Федеральное&nbsp;государственное бюджетное&nbsp;учреждение
                    </p>
                </div>
            </div>
            <div class="container auth__container">
                <form id="formLogIn" action="#!" method="post" class="auth__form logIn">
                    <div id="showLogIn" class="form__content">
                        <h2 class="auth__title">Вход</h2>
                        <ul class="auth__list">
                            <li class="auth__item">
                                <label class="auth__label"><input type="email" class="auth__input"
                                        placeholder="Электронная почта" required />
                                </label>
                            </li>
                            <li class="auth__item">
                                <label class="auth__label"><input type="password" class="auth__input" placeholder="Пароль"
                                        required />
                                </label>
                            </li>
                        </ul>
                        <div class="auth__inner">
                            {{-- <div class="auth__checkbox-inner">
                                <input type="checkbox" class="auth__checkbox" id="remember" name="remember"
                                    value="remember" />
                                <label class="auth__label-checkbox" for="remember">Запомнить меня</label>
                            </div>
                            <a href="#!" class="auth__recovery">Восстановить пароль</a> --}}
                        </div>
                        <div class="auth__wrapp-btn">
                            <button class="auth__btn logIn-btn">Войти</button>
                            <button id="changeForm1" class="auth__btn create-btn">
                                Создать аккаунт
                            </button>
                        </div>
                    </div>
                </form>
                <form id="formSignIn" action="#!" method="post" class="auth__form singIn">
                    <div id="showSingIn" class="form__content active">
                        <h2 class="auth__title">Регистрация</h2>
                        <ul class="auth__list">
                            <li class="auth__item">
                                <label class="auth__label">
                                    <input type="text" name="lastName" class="auth__input required" placeholder=""
                                        required /><span class="label-text">Фамилия <span
                                            class="red-asterisk">*</span></span>
                                </label>
                            </li>
                            <li class="auth__item">
                                <label class="auth__label">
                                    <input type="text" name="firstName" class="auth__input" placeholder=""
                                        required /><span class="label-text">Имя <span class="red-asterisk">*</span></span>
                                </label>
                            </li>
                            <li class="auth__item">
                                <label class="auth__label">
                                    <input type="text" name="secondName" class="auth__input" placeholder="" required />
                                    <span class="label-text">Отчество <span class="red-asterisk">*</span></span>
                                </label>
                            </li>
                            <li class="auth__item">
                                <label tabindex="0" class="auth__label bd required">
                                    <input id="birthdateInput" type="date" name="birthday" class="auth__input"
                                        placeholder="" required />
                                    <span class="label-text" id="spanDate">Дата Рождения<span
                                            class="red-asterisk">*</span></span>
                                </label>
                            </li>
                            <li class="auth__item">
                                <label class="auth__label">
                                    <input type="email" name="email" class="auth__input required" placeholder=""
                                        required /><span class="label-text">Электронная почта
                                        <span class="red-asterisk">*</span></span>
                                </label>
                            </li>
                            <li class="auth__item">
                                <label class="auth__label">
                                    <input type="password" name="password" class="auth__input required" placeholder=""
                                        required />
                                    <span class="label-text">Пароль<span class="red-asterisk">*</span></span>
                                </label>
                            </li>
                            <li class="auth__item">
                                <label class="auth__label">
                                    <input type="password" name="retypePassword" class="auth__input required"
                                        placeholder="" required /><span class="label-text">Повторите пароль
                                        <span class="red-asterisk">*</span></span>
                                </label>
                            </li>
                        </ul>
                        <div class="auth__inner">
                            <div class="auth__checkbox-inner">
                                <input type="checkbox" class="auth__checkbox" id="agree" name="agree"
                                    value="agree" />
                                <label class="auth__label-checkbox" for="agree">Я&nbsp;даю свое согласие
                                    на&nbsp;обработку персональных
                                    данных</label>
                            </div>
                        </div>
                        <div class="auth__wrapp-btn">
                            <button class="auth__btn logIn-btn">Создать аккаунт</button>
                            <button id="changeForm2" class="auth__btn create-btn">
                                Войти
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src='/private/src/js/swal.js?v={{ sha1_file(public_path('/private/src/js/swal.js')) }}'></script>
    <script src="{{ asset('/lib/jquery.min.js') }}"></script>
    <script defer src="{{ asset('js/pa/auth.js') }}"></script>
@endsection
