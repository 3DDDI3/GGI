<?php

use App\FileUpload;
use App\Models\Bim;
use App\Models\Gallery;
use lib\GenerateForm;

$title = 'Баннеры - главная страница';
$add = false;
$filter = false;
$path = '/upload';
$path2 = '/upload/main_videos';

$type = 'main-banners';
$type2 = 'main-banners-mobile';

$videos = \App\Models\MainVideo::findAll();


if (isset($_POST['edit'])):

    FileUpload::uploadGallery('banners', null, $type, null, 1080, $path);
    FileUpload::uploadGallery('banners2', null, $type2, null, 1080, $path);

    FileUpload::uploadFileMultiple('main_videos', $path2);

//    FileUpload::uploadFileMain('main_banner_video', $path);


    $_SESSION['notice'] = 'Изменено';
    header("Location: {$_SERVER['REQUEST_URI']}");
    exit;

else:

    $gallery = Gallery::getGallery($type);
    $gallery2 = Gallery::getGallery($type2);
    $bim = Bim::get();

    include ROOT . '/private/views/panel_header.php'; ?>

    <div class='admin_edit_block'>
        <form action='/<?= URI ?>' method='post' class='admin_edit-form'
              enctype='multipart/form-data'>

            <?= GenerateForm::makeGallery('Выберите изображения', 'banners', $gallery, $path) ?>
            <?= GenerateForm::makeGallery('Изображения для мобильной версии', 'banners2', $gallery2, $path) ?>

            <!--            --><? //= GenerateForm::makeFileMain('Видео', 'main_banner_video', $bim['main_banner_video'], $path, false, 'video/mp4', 'App\Models\Bim')
            ?>

            <div class='input_block input_file_block'>
                <span>Видео:</span>
                <input id='main_videos' type='file' name='main_videos[]' accept='video/mp4' multiple>
                <label for='main_videos'>Выбрать файлы</label>
            </div>

            <?php if (!empty($videos)): ?>
                <div class='admin_img_container'>
                    <?php foreach ($videos as $video): ?>

                        <div class='admin_img_card'>
                            <div class='card_image_block _transparent'>
                                <video controls>
                                    <source src='<?= $path2 ?>/<?= $video->file ?>' type='video/mp4'>
                                </video>
                            </div>
                            <div class='img_card_panel'>
                                <input type='text' class='main-video-rating' value='<?= $video->rating ?>' data-id='<?= $video->id ?>' placeholder='Рейтинг'>

                                <a class='img_gallery_open' title='Открыть' target='_blank'
                                   href='<?= $path2 ?>/<?= $video->file ?>'><i class='material-icons'>open_in_new</i></a>

                                <button type='button' class='main_video_delete' data-id='<?= $video->id ?>'
                                        title='Удалить'><i class='material-icons'>delete</i></button>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>
            <?php endif; ?>


            <div class='input_block'>
                <button type='submit' name='edit'>Сохранить</button>
            </div>

        </form>
    </div>

<?php endif; ?>
