<?php

use App\Models\Vacancy as Model;
use lib\GenerateForm;

$title = 'Вакансии';
$add = 'вакансии';
$filter = false;

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
        </div>

        <form action='/<?= URI ?>' method='post' class='admin_edit-form' enctype='multipart/form-data'>

            <?= GenerateForm::makeCheckbox('hide', ($object->hide == 0) ? true : false) ?>

            <?= GenerateForm::makeInput('Вакансия', 'name', $object->name, true) ?>

            <?= GenerateForm::makeSelect('Город', 'city', [
                new class
                {
                    public $id = 'Москва';
                    public $name = 'Москва';
                },
                new class
                {
                    public $id = 'Иркутск';
                    public $name = 'Иркутск';
                },
            ], $object->city) ?>

            <?= GenerateForm::makeTextbox('Описание', 'text', $object->text) ?>

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

    $object->name = $_POST['name'];
    $object->city = $_POST['city'] === '0' ? '' : $_POST['city'];
    $object->text = $_POST['text'];
    $object->rating = $_POST['rating'] ?: null;

    $object->save();

    header("Location: {$_SERVER['REQUEST_URI']}?edit=$object->id");
    exit;

elseif (isset($_GET['delete'])):

    Model::findById($_GET['delete'])->delete();

    $_SESSION['notice'] = 'Удалено';

    header('Location: /' . URI);
    exit;

else:

    include ROOT . '/private/views/panel_header.php';

    $objects = Model::findAll([], ['rating' => 'DESC', 'id' => 'ASC']);

    if (!empty($objects)): ?>
        <div class='module-help'>
            <i class='material-icons'>sort_by_alpha</i>
            <span>В этом модуле доступно изменение порядка материалов. Используйте перетаскивание мышью для сортировки.</span>
        </div>
        <div class='sortable_list'>
            <?php foreach ($objects as $object):
                $name = $object->name;
                if (!empty($object->city)) $name .= ' (' . $object->city . ')'; ?>

                <div class='list_item'>
                    <div class='list_item-info'>
                        <h4><?= $name ?></h4>
                    </div>
                    <div class='list_item-actions'>
                        <input type='text' class='rating-change' value='<?= $object->rating ?>'
                               data-id='<?= $object->id ?>'
                               data-class='<?= get_class($object) ?>' placeholder='Рейтинг'>
                        <div class='admin_show <?= ($object->hide == 0) ? 'admin_show_act' : '' ?>'
                             title='Показывать на сайте' data-id='<?= $object->id ?>'
                             data-class='<?= get_class($object) ?>'></div>
                        <a href='?edit=<?= $object->id ?>' class='admin_edit' title='Редактировать'></a>
                        <a href='?delete=<?= $object->id ?>' class='admin_delete' title='Удалить'></a>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class='not_found'>Ничего не найдено</div>
    <?php endif;

endif;
