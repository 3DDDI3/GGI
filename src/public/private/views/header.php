<!doctype html>
<html lang='ru'>
<head>
    <meta charset='UTF-8'>
    <title>Панель управления сайтом | VisualTeam</title>

    <link rel='shortcut icon' href='/private/src/images/favicon.ico'>

    <!-- Summernote -->
    <link rel='stylesheet' href='/lib/Summernote/summernote-lite.min.css'>

    <!-- MDL -->
    <!-- <link rel='stylesheet' href='/lib/mdl/material.min.css'>-->
     <link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>

    <!-- JqueryUi -->
    <link rel='stylesheet' href='/lib/jquery-ui-sortable/jquery-ui.min.css'>

    <!-- CSS -->
    <link rel='stylesheet' href='/private/src/css/main.css?v=<?= md5_file('private/src/css/main.css') ?>'>
    <link rel='stylesheet' href='/private/src/css/local.css?v=<?= md5_file('private/src/css/local.css') ?>'>
</head>
<body>

<?php if (isset($this->admin)): ?>

    <header class='admin_header'>

        <div class='admin_logo'>
            <a href='/' target='_blank'>
                <img src='/private/src/images/logo.png' alt=''>
            </a>
        </div>

        <div class='admin_control'>
            <span>Вы вошли как: <b><?= $this->admin ?></b></span>
            <a href='/admin/logout' class='admin_logout'>Выйти</a>
        </div>

    </header>

<?php endif; ?>

<?php if (isset($_SESSION['notice'])) :

    $notice = $_SESSION['notice'];
    unset($_SESSION['notice']);

?>

    <div class='notice'>
        <div id='black'></div>
        <div id='alert'>
            <div class='alert_head'>Уведомление</div>
            <span class='alert_text'><?= $notice ?></span>
            <button type='button' class='button_alert'>ОК</button>
        </div>
    </div>

<?php endif; ?>
