<?php

use App\Models\Admins;
use lib\GenerateForm;

$title = 'Администраторы';
$add = 'Администратора';
$filter = false;

$uri = URI;

if (isset($_GET['add']) || isset($_GET['edit'])):

    $id = $_GET['edit'] ?? false;

    if ($id) {
        $admin = Admins::findById($id);
    } else {
        $admin = new Admins();
    }

?>

    <h1><?= $id ? "Редактирование $add: $admin->login" : "Добавление $add" ?></h1>

    <div class='admin_edit_block'>

        <div class='admin_edit-links'>
            <a href='/<?= $uri ?>'>Назад к списку</a>
        </div>

        <form action='/<?= $uri ?>' method='post' class='admin_edit-form'>

            <?= GenerateForm::makeInput('Логин', 'login', $admin->login, true) ?>
            <?= GenerateForm::makeInput('Пароль', 'password', '', !$id ? true : false, 'password') ?>
            <?= GenerateForm::makeSubmit($id, $admin->id) ?>

        </form>

    </div>

<?php elseif (isset($_POST['add']) || isset($_POST['edit'])):

    if (isset($_POST['edit'])) {

        $admin = Admins::findById($_POST['edit']);
        $_SESSION['notice'] = 'Изменено';

        if ($admin->login == $_SESSION['admin']) {
            $_SESSION['admin'] = $_POST['login'];
        }

    } else {

        $admin = new Admins();
        $_SESSION['notice'] = 'Добавлено';

    }

    $admin->login = $_POST['login'];

    if (!empty($_POST['password'])) {
        $admin->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }

    $admin->save();

    header("Location: {$_SERVER['REQUEST_URI']}?edit=$admin->id");
    exit;

elseif (isset($_GET['delete'])):

    if ($_GET['delete'] != 1) {

        $admin = Admins::findById($_GET['delete']);
        $admin->delete();

        if ($admin->login == $_SESSION['admin']) {
            Admins::logout();
        }

        $_SESSION['notice'] = 'Удалено';

    } else {
        $_SESSION['notice'] = 'Вы не можете удалить этого пользователя';
    }

    header("Location: /$uri");
    exit;

else:

    include ROOT . '/private/views/panel_header.php';

    $admins = Admins::findAll();

    foreach ($admins as $admin): ?>

        <div class='list_item'>
            <div class='list_item-info'>
                <h4><?= $admin->login ?></h4>
            </div>
            <div class='list_item-actions'>
                <a href='?edit=<?= $admin->id ?>' class='admin_edit' title='Редактировать'></a>
                <?php if ($admin->id != 1): ?>
                    <a href='?delete=<?= $admin->id ?>' class='admin_delete' title='Удалить'></a>
                <?php endif; ?>
            </div>
        </div>

    <?php endforeach;
endif;
