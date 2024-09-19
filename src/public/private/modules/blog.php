<?php

use App\Models\Blog as Model;
use lib\GenerateForm;
use App\FileUpload;
use lib\Helpers;

$title = 'Блог';
$add = 'статьи';
$filter = true;

$path = '/upload/blog';

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
                <a href='/blog/<?= $object->url ?>' target='_blank'>Посмотреть на сайте</a>
            <?php endif; ?>
        </div>

        <form action='/<?= URI ?>' method='post' class='admin_edit-form' enctype='multipart/form-data'>

            <?= GenerateForm::makeCheckbox('hide', ($object->hide == 0) ? true : false) ?>

            <?= GenerateForm::makeInput('Название', 'name', $object->name, true) ?>
            <?= GenerateForm::makeInput('Ссылка', 'url', $object->url) ?>
            <?= GenerateForm::makeTextarea('Краткое описание', 'description', $object->description) ?>

            <?= GenerateForm::makeImage('Превью', 'preview', $object, $path) ?>

            <?= GenerateForm::makeInput('Дата', 'date', $object->date ? date('Y-m-d', $object->date) : '', false, 'date') ?>
            <?= GenerateForm::makeInput('Автор', 'author', $object->author) ?>
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

    isset($_POST['hide']) ? $object->hide = 0 : $object->hide = 1;

    if (!empty($_POST['url'])) {
        $url = Helpers::str2url($_POST['url']);
    } else {
        $url = Helpers::str2url($_POST['name']);
    }

    $object->name = $_POST['name'];
    $object->url = $url;
    $object->description = $_POST['description'];

    if (!empty($_POST['date'])) {
        $object->date = strtotime($_POST['date']);
    }
    $object->author = $_POST['author'];
    $object->rating = $_POST['rating'] ?: null;

    $object->save();

    FileUpload::uploadImage('preview', get_class($object), 'preview', $object->id, 510, 510, $path);

    header("Location: {$_SERVER['REQUEST_URI']}?edit=$object->id");
    exit;

elseif (isset($_GET['delete'])):

    $object = Model::findById($_GET['delete']);

    unlink(ROOT . $path . '/' . $object->preview);

    $object->delete();

    $_SESSION['notice'] = 'Удалено';

    header('Location: /' . URI);
    exit;

else:

    include ROOT . '/private/views/panel_header.php';

    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $objects = Model::searchByName($_GET['search']);
    } else {
        $objects = Model::findAll([], ['rating' => 'DESC', 'id' => 'ASC']);
    }

    if (!empty($objects)):
        foreach ($objects as $object): ?>
            <div class='list_item'>
                <div class='list_item-info list_item-flex'>
                    <?php if ($object->preview): ?>
                        <img src='<?= $path . '/' . $object->preview ?>' alt=''>
                    <?php endif; ?>
                    <div>
                        <h4><?= $object->name ?></h4>
                    </div>
                </div>
                <div class='list_item-actions'>
                    <a href='/admin/constructor?id=<?= $object->id ?>' style='color:#5583FD;margin-right: 10px;'>Перейти в констуктор</a>
                    <input type='text' class='rating-change' value='<?= $object->rating ?>'
                           data-id='<?= $object->id ?>'
                           data-class='<?= get_class($object) ?>' placeholder='Рейтинг'>
                    <a class='admin_open' title='Открыть' target='_blank' href='/blog/<?= $object->url ?>'></a>
                    <div class='admin_show <?= ($object->hide == 0) ? 'admin_show_act' : '' ?>'
                         title='Показывать на сайте' data-id='<?= $object->id ?>'
                         data-class='<?= get_class($object) ?>'></div>
                    <a href='?edit=<?= $object->id ?>' class='admin_edit' title='Редактировать'></a>
                    <a href='?delete=<?= $object->id ?>' class='admin_delete' title='Удалить'></a>
                </div>
            </div>
        <?php endforeach;
    else: ?>
        <div class='not_found'>Ничего не найдено</div>
    <?php endif;

endif;
