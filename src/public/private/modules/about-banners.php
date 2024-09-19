<?php

use App\FileUpload;
use App\Models\Gallery;
use lib\GenerateForm;

$title = 'Баннеры - о компании';
$add = false;
$filter = false;
$path = '/upload';

$type = 'about-banners';
$type2 = 'about-banners-mobile';


if (isset($_POST['edit'])):

    FileUpload::uploadGallery('banners', null, $type, null, 1080, $path);
    FileUpload::uploadGallery('banners2', null, $type2, null, 1080, $path);

    $_SESSION['notice'] = 'Изменено';
    header("Location: {$_SERVER['REQUEST_URI']}");
    exit;

else:

    $gallery = Gallery::getGallery($type);
    $gallery2 = Gallery::getGallery($type2);

    include ROOT . '/private/views/panel_header.php'; ?>

    <div class='admin_edit_block'>
        <form action='/<?= URI ?>' method='post' class='admin_edit-form'
              enctype='multipart/form-data'>

            <?= GenerateForm::makeGallery('Выберите изображения', 'banners', $gallery, $path) ?>
            <?= GenerateForm::makeGallery('Изображения для мобильной версии', 'banners2', $gallery2, $path) ?>


            <div class='input_block'>
                <button type='submit' name='edit'>Сохранить</button>
            </div>

        </form>
    </div>

<?php endif; ?>
