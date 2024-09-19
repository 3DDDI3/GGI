<?php

use App\FileUpload;
use App\Models\Pages as Model;
use lib\GenerateForm;
use lib\Helpers;

$title = 'Страницы';
$add = 'Страницы';
$filter = true;

$path = '/upload';

if (isset($_GET['add']) || isset($_GET['edit'])):

    $id = $_GET['edit'] ?? false;

    if ($id) {
        $object = Model::findById($id);

    } else {
        $object = new Model();
    }

    ?>

    <h1><?= $id ? "Редактирование $add: $object->name" : "Добавление $add" ?></h1>

    <div class='admin_edit_block'>

        <div class='admin_edit-links'>
            <a href='/<?= URI ?>'>Назад к списку</a>

            <?php if ($id): ?>
                <a href='/<?= $object->url ?>' target='_blank'>Посмотреть на сайте</a>
            <?php endif; ?>

        </div>

        <form action='/<?= URI ?>' method='post' class='admin_edit-form' enctype='multipart/form-data'>

            <?= GenerateForm::makeCheckbox('hide', ($object->hide == 0) ? true : false) ?>
            <?= GenerateForm::makeCheckbox('header_show', ($object->header_show == 1) ? true : false, 'Показывать в меню') ?>

            <?= GenerateForm::makeInput('Название', 'name', $object->name, true) ?>
            <?= GenerateForm::makeInput('Ссылка', 'url', $object->url) ?>
            <?= GenerateForm::makeTextbox('Текст', 'text', $object->text) ?>

            <?php if ($object->id == 1) {
                echo GenerateForm::makeImage('Фото директора', 'image', $object, $path);
            } ?>

            <?= GenerateForm::makeInput('Рейтинг', 'rating', $object->rating) ?>
            <?= GenerateForm::makeSubmit($id, $object->id) ?>

        </form>

    </div>

<?php elseif (isset($_POST['add']) || isset($_POST['edit'])):

    if (isset($_POST['edit'])) {

        $object = Model::findById($_POST['edit']);
        $_SESSION['notice'] = 'Изменено';

    } else {

        $object = new Model();
        $_SESSION['notice'] = 'Добавлено';

    }

    if (!empty($_POST['url'])) {
        $url = Helpers::str2url($_POST['url']);
    } else {
        $url = Helpers::str2url($_POST['name']);
    }

    isset($_POST['hide']) ? $object->hide = 0 : $object->hide = 1;
    isset($_POST['header_show']) ? $object->header_show = 1 : $object->header_show = 0;

    $object->name = $_POST['name'];
    $object->url = $url;
    $object->text = $_POST['text'];
    $object->rating = $_POST['rating'] ?: null;

    $urlCheck = Model::findByUrl($url);
    if ($urlCheck && $urlCheck->id != $object->id) {
        $urlCheck->url = $url . '-' . $urlCheck->id;
        $urlCheck->save();

        $object->save();
        $object->url = $url . '-' . $object->id;
        $object->save();

        $urlCheck->url = $url;
        $urlCheck->save();
    } else {
        $object->save();
    }

    FileUpload::uploadImage('image', get_class($object), 'image', $object->id, null, 350, $path);

    header("Location: {$_SERVER['REQUEST_URI']}?edit=$object->id");
    exit;

elseif (isset($_GET['delete'])):

    Model::findById($_GET['delete'])->delete();

    $_SESSION['notice'] = 'Удалено';

    header('Location: /' . URI);
    exit;

else:

    include ROOT . '/private/views/panel_header.php';

    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $objects = Model::searchByName($_GET['search']);
        $sortable = false;
    } else {
        $objects = Model::findAll([], ['rating' => 'DESC', 'id' => 'ASC']);
        $sortable = true;
    }

    if (!empty($objects)):

        if ($sortable) : ?>
            <div class='module-help'>
                <i class='material-icons'>sort_by_alpha</i>
                <span>В этом модуле доступно изменение порядка материалов. Используйте перетаскивание мышью для сортировки.</span>
            </div>
            <div class='sortable_list'>
        <?php endif;

        foreach ($objects as $object): ?>
            <div class='list_item'>
                <div class='list_item-info'>
                    <h4><?= $object->name ?></h4>

                    <?php if ($object->header_show == 1): ?>
                        <span class='menu_show info'>Показывается в меню</span><br>
                    <?php endif; ?>
                </div>
                <div class='list_item-actions'>
                    <input type='text' class='rating-change' value='<?= $object->rating ?>' data-id='<?= $object->id ?>'
                           data-class='<?= get_class($object) ?>' placeholder='Рейтинг'>
                    <a class='admin_open' title='Открыть' target='_blank' href='/<?= $object->url ?>'></a>
                    <div class='admin_show <?= ($object->hide == 0) ? 'admin_show_act' : '' ?>'
                         title='Показывать на сайте' data-id='<?= $object->id ?>'
                         data-class='<?= get_class($object) ?>'></div>
                    <a href='?edit=<?= $object->id ?>' class='admin_edit' title='Редактировать'></a>
                    <a href='?delete=<?= $object->id ?>' class='admin_delete' title='Удалить'></a>
                </div>
            </div>
        <?php endforeach; ?>

        <?php if ($sortable): ?>
            </div>
        <?php endif;

    else: ?>
        <div class='not_found'>Ничего не найдено</div>
    <?php endif;

endif;
