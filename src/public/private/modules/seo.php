<?php

use lib\GenerateForm;
use App\Models\Seo;

$title = 'SEO';
$add = 'SEO';
$filter = false;

$uri = URI;

if (isset($_GET['add']) || isset($_GET['edit'])):

    $id = $_GET['edit'] ?? false;

    if ($id) {
        $seo = Seo::findById($id);
    } else {
        $seo = new Seo();
    }

    ?>

    <h1><?= $id ? "Редактирование $add: $seo->url" : "Добавление $add" ?></h1>

    <div class='admin_edit_block'>

        <div class='admin_edit-links'>
            <a href='/<?= $uri ?>'>Назад к списку</a>

            <?php if ($id): ?>
                <a href='/<?= $seo->url ?>' target='_blank'>Посмотреть на сайте</a>
            <?php endif; ?>

        </div>

        <form action='/<?= $uri ?>' method='post' class='admin_edit-form' enctype='multipart/form-data'>

            <?= GenerateForm::makeInput('URL страницы', 'url', $seo->url, true) ?>

            <div>
                <p><span class='menu_show danger'>Неправильно: <span style='color: #000;'>http://site.ru/catalog</span></span></p>
                <p><span class='menu_show primary'>Правильно: <span style='color:#000;'>catalog</span></span></p>
            </div>

            <?= GenerateForm::makeInput('Title', 'title', $seo->title) ?>
            <?= GenerateForm::makeInput('Keywords', 'keywords', $seo->keywords) ?>
            <?= GenerateForm::makeTextarea('Description', 'description', $seo->description) ?>
            <?= GenerateForm::makeSubmit($id, $seo->id) ?>

        </form>

    </div>

<?php elseif (isset($_POST['add']) || isset($_POST['edit'])):

    if (isset($_POST['edit'])) {

        $seo = Seo::findById($_POST['edit']);
        $_SESSION['notice'] = 'Изменено';

    } else {

        $seo = new Seo();
        $_SESSION['notice'] = 'Добавлено';
    }

    $seo->url = $_POST['url'];
    $seo->title = $_POST['title'];
    $seo->keywords = $_POST['keywords'];
    $seo->description = $_POST['description'];

    $seo->save();

    header("Location: {$_SERVER['REQUEST_URI']}?edit=$seo->id");
    exit;

elseif (isset($_GET['delete'])):

    Seo::findById($_GET['delete'])->delete();

    $_SESSION['notice'] = 'Удалено';

    header("Location: /$uri");
    exit;

else:

    include ROOT . '/private/views/panel_header.php';

    $seo = Seo::findAll();

    if (!empty($seo)):

        foreach ($seo as $item): ?>

            <div class='list_item'>
                <div class='list_item-info'>
                    <h4><a href='<?= $item->url != '/' ? '/' . $item->url : '/' ?>' target='_blank'
                           title='Перейти'><?= $item->url != '/' ? '/' . $item->url : 'Главная' ?></a></h4>
                </div>
                <div class='list_item-actions'>
                    <a class='admin_open' title='Открыть' target='_blank' href='/<?= $item->url ?>'></a>
                    <a href='?edit=<?= $item->id ?>' class='admin_edit' title='Редактировать'></a>
                    <a href='?delete=<?= $item->id ?>' class='admin_delete' title='Удалить'></a>
                </div>
            </div>

        <?php endforeach;

    else: ?>
        <div class='not_found'>Ничего не найдено</div>
    <?php endif;

endif;
