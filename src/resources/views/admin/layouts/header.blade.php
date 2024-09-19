@include('admin.layouts.head')

{{--<?php if (isset($this->admin)): ?>--}}
@php $user = auth()->user(); @endphp
<header class='admin_header'>

    <div class='admin_logo'>
        <a href='/' target='_blank'>
            <img src='/private/src/images/logo.png' alt=''>
        </a>
    </div>

    <div class='admin_control'>
        <span>Вы вошли как: <b>{{$user->email}}</b></span>
        <a href='/admin/logout' class='admin_logout'>Выйти</a>
    </div>

</header>

{{--<?php //endif; ?>--}}

{{--<?php if (isset($_SESSION['notice'])) :--}}

{{--$notice = $_SESSION['notice'];--}}
{{--unset($_SESSION['notice']);--}}

{{--?>--}}


@if($message=session()->get('message'))
    <div class='notice'>
        <div id='black'></div>
        <div id='alert'>
            <div class='alert_head'>Уведомление</div>
            <span class='alert_text'>{{$message}}</span>
            <button type='button' class='button_alert'>ОК</button>
        </div>
    </div>
@endif


