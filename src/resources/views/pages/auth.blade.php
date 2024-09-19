@extends('layouts.default')
@section('content')
    <div class="page page_auth">
        <div class="page__container page_auth__container container">
            <div class="breadcrumbs">
                <div class="breadcrumbs__container">
                    <div class="breadcrumbs__grid _flex">
                        <a href="/" class="breadcrumbs__item">{{__('Главная')}}</a>
                        <span class="breadcrumbs__slash">/</span> 
                        <span class="breadcrumbs__item">{{__('Учётная запись пользователя')}}</span>
                    </div>
                </div>
            </div>
            <h1 class="page_service__title page-title">{{__('Учётная запись пользователя')}}</h1>
            <div class="page_auth__grid _flex">
                <div class="page_auth__auth auth js-auth">
                    <div class="auth__container">
                        <div class="auth__primary auth__primary_active js-auth__primary js-tabs-wrapper">
                            <div class="auth__tabs js-tabs _flex">
                                <button type="button" class="auth__tab js-tab tab tab-active" data-box="enter">{{__('Вход')}}</button>
                                <button type="button" class="auth__tab js-tab tab" data-box="registration">{{__('Регистрация')}}</button>
                            </div>
                            <div class="auth__tabs-boxes js-tabs-boxes">
                                <div class="auth__tab-box js-tab-box tab-box tab-box-active" data-tab="enter">
                                    <form class="auth__form auth__form_enter" action="#" method="post">
                                        <div class="auth__block">
                                            <input type="text" class="auth__input input" placeholder="{{__('Ваше имя')}}">
                                            <div class="auth__notice">{{__('Вы можете войти с зарегистрированным именем пользователя или вашим e-mail адресом')}}.</div>
                                        </div>
                                        <div class="auth__block">
                                            <input type="password" class="auth__input input" placeholder="{{__('Пароль')}}">
                                            <div class="auth__notice">{{__('Пароль чувствителен к регистру')}}.</div>
                                        </div>
                                        <button type="submit" class="auth__submit button">{{__('Войти')}}</button>
                                    </form>
                                </div>
                                <div class="auth__tab-box js-tab-box tab-box" data-tab="registration">
                                    <form class="auth__form auth__form_registration" action="#" method="post">
                                        <div class="auth__block">
                                            <input type="text" class="auth__input input" placeholder="{{__('Ваше имя')}}">
                                            <div class="auth__notice">{{__('Пробелы разрешены; знаки пунктуации запрещены, за исключением точек, тире, апострофов и знаков подчеркивания')}}.</div>
                                        </div>
                                        <div class="auth__block">
                                            <input type="text" class="auth__input input" placeholder="E-mail">
                                            <div class="auth__notice">{{__('Существующий адрес электронной почты. Все почтовые сообщения с сайта будут отсылаться на этот адрес. Адрес электронной почты не будет публиковаться и будет использован только по вашему желанию: для восстановления пароля или для получения новостей и уведомлений по электронной почте')}}.</div>
                                        </div>
                                        <div class="auth__block">
                                            <div class="auth__captcha _flex">
                                                <img src="/images/captcha.jpg" alt="captcha">
                                                <input type="text" class="auth__input input" placeholder="{{__('Введите символы')}}">
                                            </div>
                                            <div class="auth__notice">{{__('Введите символы показанные на картинке')}}.</div>
                                        </div>
                                        <button type="submit" class="auth__submit button">{{__('Регистрация')}}</button>
                                    </form>
                                </div>
                            </div>
                            <button class="auth__forgot-password-button js-auth__forgot-password-button" type="button">{{__('Забыли пароль')}}?</button>
                        </div>
                        <div class="auth__forgot-password-box js-auth__forgot-password-box">
                            <form class="auth__form auth__form_forgot_password" action="#" method="post">
                                <div class="auth__tabs js-tabs _flex">
                                    <div class="auth__tab tab tab-active">{{__('Забыли пароль')}}?</div>
                                </div>
                                <div class="auth__block">
                                    <input type="text" class="auth__input input" placeholder="E-mail">
                                    <div class="auth__notice">{{__('Вы можете войти с зарегистрированным именем пользователя или вашим e-mail адресом')}}.</div>
                                </div>
                                <div class="auth__block">
                                    <div class="auth__captcha _flex">
                                        <img src="/images/captcha.jpg" alt="captcha">
                                        <input type="text" class="auth__input input" placeholder="{{__('Введите символы')}}">
                                    </div>
                                    <div class="auth__notice">{{__('Введите символы показанные на картинке')}}.</div>
                                </div>
                                <button type="submit" class="auth__submit button">{{__('Выслать новый пароль')}}</button>
                                <button type="button" class="auth__primary-button js-auth__primary-button">
                                    <svg  xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
                                        <g clip-path="url(#clip0_66_16132)">
                                          <path d="M17 9.83408C17 12.6047 14.746 14.8587 11.9754 14.8587H4.67362C4.53273 14.8587 4.3976 14.8028 4.29797 14.7031C4.19834 14.6035 4.14237 14.4684 4.14237 14.3275C4.14237 14.1866 4.19834 14.0515 4.29797 13.9518C4.3976 13.8522 4.53273 13.7962 4.67362 13.7962H11.9754C13.0242 13.7932 14.0291 13.3744 14.7696 12.6317C15.5102 11.889 15.9261 10.8829 15.9261 9.8341C15.9261 8.78526 15.5102 7.77921 14.7696 7.03649C14.0291 6.29377 13.0242 5.87499 11.9754 5.87196H1.80212L3.54279 7.63544C3.59231 7.68498 3.63154 7.74382 3.65823 7.80858C3.68492 7.87334 3.69854 7.94274 3.69831 8.01279C3.69807 8.08283 3.68399 8.15214 3.65687 8.21672C3.62974 8.2813 3.59012 8.33988 3.54027 8.38908C3.49042 8.43829 3.43133 8.47715 3.36641 8.50344C3.30148 8.52972 3.232 8.54291 3.16196 8.54223C3.09192 8.54156 3.0227 8.52704 2.95829 8.49952C2.89388 8.47199 2.83555 8.432 2.78666 8.38185L0.153184 5.71391C0.0550343 5.61449 0 5.4804 0 5.34069C0 5.20098 0.0550343 5.06689 0.153184 4.96747L2.78672 2.29953C2.83552 2.24897 2.89387 2.20859 2.95838 2.18073C3.02289 2.15288 3.09229 2.1381 3.16256 2.13725C3.23283 2.1364 3.30256 2.1495 3.36773 2.17578C3.4329 2.20207 3.4922 2.24103 3.54221 2.2904C3.59222 2.33977 3.63193 2.39857 3.65906 2.46339C3.68618 2.52821 3.70018 2.59778 3.70023 2.66805C3.70029 2.73832 3.6864 2.8079 3.65937 2.87277C3.63235 2.93763 3.59272 2.99649 3.54279 3.04594L1.80212 4.80946H11.9756C14.746 4.80946 17 7.06348 17 9.83408Z" fill="#008DF2"/>
                                        </g>
                                        <defs>
                                          <clipPath id="clip0_66_16132">
                                            <rect width="17" height="17" fill="white"/>
                                          </clipPath>
                                        </defs>
                                      </svg>
                                      <span>{{__('Назад')}}</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- <div class="page_auth__image"> --}}
                    {{-- <picture class="page_auth__picture"> --}}
                        {{-- <img class="page_auth__img" src="/images/auth-banner.png" alt="auth"> --}}
                    {{-- </picture> --}}
                {{-- </div> --}}
            </div>
        </div>
    </div>

@endsection