<?php

use App\FileUpload;
use App\Models\Categories;
use App\Models\Gallery;
use App\Models\Project as Model;
use App\Models\ProjectCategories;
use lib\GenerateForm;
use lib\Helpers;

$title = 'Проекты';
$add = 'проекта';
$filter = true;

$path = '/upload/projects';
$type = 'license';
$type2 = 'project-gallery';
$type3 = 'project-banner';
$type4 = 'project-mobile-banner';

if (isset($_GET['add']) || isset($_GET['edit'])):

    $id = $_GET['edit'] ?? false;
    $categories = Categories::findAll(['hide' => 0], ['rating' => 'DESC', 'id' => 'ASC']);

    if ($id) {
        $object = Model::findById($id);
        $licenses = Gallery::getGallery($type, $id);
        $gallery = Gallery::getGallery($type2, $id);
        $banners = Gallery::getGallery($type3, $id);
        $mobileBanners = Gallery::getGallery($type4, $id);
        $selectedCategories = ProjectCategories::getSelected($id);

    } else {
        $object = new Model();
        $licenses = null;
        $gallery = null;
        $banners = null;
        $mobileBanners = null;
        $selectedCategories = [];
    }

    ?>

    <h1><?= $id ? "Редактирование $add: $object->name" : "Добавление $add" ?></h1>

    <div class='admin_edit_block'>

        <div class='admin_edit-links'>
            <a href='/<?= URI ?>'>Назад к списку</a>

            <?php if ($id): ?>
                <a href='/project/<?= $object->url ?>' target='_blank'>Посмотреть на сайте</a>
            <?php endif; ?>

        </div>

        <form action='/<?= URI ?>' method='post' class='admin_edit-form' enctype='multipart/form-data'>

            <?= GenerateForm::makeCheckbox('hide', ($object->hide == 0) ? true : false) ?>

            <?= GenerateForm::makeTextarea('Название', 'name', $object->name) ?>
            <?= GenerateForm::makeTextarea('Краткое описание', 'description', $object->description) ?>
            <?= GenerateForm::makeInput('Ссылка', 'url', $object->url) ?>

            <fieldset>
                <legend>Баннер</legend>
                <!--                --><? //= GenerateForm::makeImage('Статичное фоновое изображение', 'background', $object, $path) ?>
                <?= GenerateForm::makeGallery('Фоновое изображение', 'banners', $banners, $path) ?>
                <?= GenerateForm::makeGallery('Изображения для мобильной версии', 'mobile_banners', $mobileBanners, $path) ?>
<!--                --><?//= GenerateForm::makeFile('Видео (mp4)', 'background_video', $object, $path, false, 'video/mp4') ?>

            </fieldset>

<!--            --><?//= GenerateForm::makeInput('Фотограф', 'photographer', $object->photographer) ?>

            <?= GenerateForm::makeMultipleSelect('Категориии', 'categories', $categories, $selectedCategories) ?>

            <fieldset>
                <legend>Превью</legend>
                <?= GenerateForm::makeInput('Название', 'preview_name', $object->preview_name) ?>
                <span class='menu_show info'>Будет отображаться основное название, если оставить пустым</span>
                <?= GenerateForm::makeImage('Изображение', 'preview', $object, $path) ?>
            </fieldset>

            <fieldset>
                <legend>Показывать на главной</legend>
                <?= GenerateForm::makeCheckbox('banner_show', ($object->banner_show == 1) ? true : false, 'Показывать') ?>
                <?= GenerateForm::makeTextarea('Название', 'banner_name', $object->banner_name) ?>
                <span class='menu_show info'>Будет отображаться основное название, если оставить пустым</span>
<!--                --><?//= GenerateForm::makeInput('Категория', 'banner_text', $object->banner_text) ?>
                <?= GenerateForm::makeImage('Изображение', 'banner_img', $object, $path) ?>
            </fieldset>

            <fieldset>
                <legend>Информация</legend>
                <?= GenerateForm::makeTextbox('Текст слева', 'text', $object->text) ?>
                <?= GenerateForm::makeTextbox('Текст справа', 'authors', $object->authors) ?>

                <?= GenerateForm::makeInput('Общая площадь (м<sup>2</sup>)', 'total_area', $object->total_area) ?>
                <?= GenerateForm::makeInput('Город', 'building_area', $object->building_area) ?>
                <?= GenerateForm::makeInput('Год постройки', 'year', $object->year) ?>
<!--                --><?//= GenerateForm::makeInput('Заказчик', 'customer', $object->customer) ?>
<!--                --><?//= GenerateForm::makeTextarea('Авторы', 'authors', $object->authors) ?>

<!--                --><?//= GenerateForm::makeGallery('Лицензии', 'licenses', $licenses, $path) ?>

            </fieldset>

            <?= GenerateForm::makeGallery('Галерея', 'gallery', $gallery, $path) ?>

            <!-- <fieldset>
                <legend>Видео</legend>
                <?= GenerateForm::makeImage('Обложка видео', 'video_background', $object, $path) ?>
                <?= GenerateForm::makeTextarea('Название', 'video_title', $object->video_title) ?>
                <?= GenerateForm::makeFile('Файл (mp4)', 'video', $object, $path, false, 'video/mp4') ?>
            </fieldset> -->

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

    $object->name = $_POST['name'];
    $object->url = $url;
    $object->preview_name = $_POST['preview_name'];
    $object->description = $_POST['description'];
    $object->text = $_POST['text'];

    $object->photographer = $_POST['photographer'];

    $object->total_area = $_POST['total_area'];
    $object->building_area = $_POST['building_area'];
    $object->year = $_POST['year'];
    $object->customer = $_POST['customer'];
    $object->authors = $_POST['authors'];

    $object->video_title = $_POST['video_title'];

    isset($_POST['banner_show']) ? $object->banner_show = 1 : $object->banner_show = 0;
    $object->banner_name = $_POST['banner_name'];
    $object->banner_text = $_POST['banner_text'];

    $object->rating = $_POST['rating'] ?: null;

    $object->save();

    $selectedCategories = ProjectCategories::getSelected($object->id);

    if (isset($_POST['categories'])) {
        foreach ($_POST['categories'] as $categoryId) {

            if (($key = array_search($categoryId, $selectedCategories)) !== false) {
                unset($selectedCategories[$key]);
                continue;
            }

            $projectCategory = new ProjectCategories();
            $projectCategory->project_id = $object->id;
            $projectCategory->category_id = $categoryId;
            $projectCategory->save();
        }
    }

    ProjectCategories::deleteCategory($selectedCategories, $object->id);

    FileUpload::uploadImage('preview', get_class($object), 'preview', $object->id, null, 600, $path);
//    FileUpload::uploadImage('background', get_class($object), 'background', $object->id, null, 900, $path);
    FileUpload::uploadImage('video_background', get_class($object), 'video_background', $object->id, null, 900, $path);
    FileUpload::uploadImage('banner_img', get_class($object), 'banner_img', $object->id, null, 600, $path);

    FileUpload::uploadGallery('licenses', $object->id, $type, 70, 95, $path);
    FileUpload::uploadGallery('gallery', $object->id, $type2, null, 1280, $path);
    FileUpload::uploadGallery('banners', $object->id, $type3, null, 1080, $path);
    FileUpload::uploadGallery('mobile_banners', $object->id, $type4, null, 1080, $path);

    FileUpload::uploadFile('video', get_class($object), 'video', $object->id, $path);
    FileUpload::uploadFile('background_video', get_class($object), 'background_video', $object->id, $path);

    header("Location: {$_SERVER['REQUEST_URI']}?edit=$object->id");
    exit;

elseif (isset($_GET['delete'])):

    $object = Model::findById($_GET['delete']);

    unlink(ROOT . $path . '/' . $object->preview);
    unlink(ROOT . $path . '/' . $object->background);
    unlink(ROOT . $path . '/' . $object->video_background);
    unlink(ROOT . $path . '/' . $object->video);
    unlink(ROOT . $path . '/' . $object->banner_img);

    Gallery::deleteGallery($object->id, $type, $path);
    Gallery::deleteGallery($object->id, $type2, $path);
    Gallery::deleteGallery($object->id, $type3, $path);
    Gallery::deleteGallery($object->id, $type4, $path);

//    ProjectCategories::deleteByProjectId($object->id);

    $object->delete();

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
                <div class='list_item-info list_item-flex'>
                    <?php if ($object->preview): ?>
                        <img src='<?= $path . '/' . $object->preview ?>' alt=''>
                    <?php endif; ?>
                    <div>
                        <h4><?= $object->name ?></h4>
                        <?php if ($object->banner_show == 1): ?>
                            <span class='menu_show info'>Показывается в баннере на главной</span><br>
                        <?php endif; ?>
                    </div>
                </div>
                <div class='list_item-actions'>
                    <!-- <a href='/admin/project-constructor?id=<?= $object->id ?>'
                       style='color:#5583FD;margin-right: 10px;'>Перейти в констуктор</a> -->
                    <input type='text' class='rating-change' value='<?= $object->rating ?>'
                           data-id='<?= $object->id ?>'
                           data-class='<?= get_class($object) ?>' placeholder='Рейтинг'>
                    <a class='admin_open' title='Открыть' target='_blank' href='/project/<?= $object->url ?>'></a>
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
