<?php

use App\FileUpload;
use App\Models\Bim;
use App\Models\Gallery;
use lib\GenerateForm;

$title = 'BIM';
$add = false;
$filter = false;
$path = '/upload/bim';

$type1 = 'bim_slider_1';
$type2 = 'bim_slider_2';


if (isset($_POST['edit'])):

    unset($_POST['edit']);

    foreach ($_POST as $name => $value) {
        $bim = Bim::findByName($name);
        $bim->value = $value;
        $bim->save();
    }

    FileUpload::uploadImageMain('image1', 635, null, $path);
    FileUpload::uploadImageMain('image2', 635, null, $path);
//    FileUpload::uploadImageMain('image3', null, 710, $path);

//    FileUpload::uploadFileMain('video', $path);

    FileUpload::uploadGallery('bim_slider_1', null, $type1, null, 210, $path);
    FileUpload::uploadGallery('bim_slider_2', null, $type2, null, 210, $path);


    $_SESSION['notice'] = 'Изменено';
    header("Location: {$_SERVER['REQUEST_URI']}");
    exit;

else:

    $bim = Bim::get();
    $gallery1 = Gallery::getGallery($type1);
    $gallery2 = Gallery::getGallery($type2);

    include ROOT . '/private/views/panel_header.php'; ?>

    <div class='admin_edit_block'>
        <form action='/<?= URI ?>' method='post' class='admin_edit-form'
              enctype='multipart/form-data'>

            <?= GenerateForm::makeTextbox('Текст 1', 'text1', $bim['text1']['value']) ?>
            <?= GenerateForm::makeTextbox('Текст 2', 'text2', $bim['text2']['value']) ?>
            <?= GenerateForm::makeTextbox('Текст 3', 'text3', $bim['text3']['value']) ?>
            <?= GenerateForm::makeImageMain('Изображение 1', 'image1', $bim['image1'], $path) ?>
            <?= GenerateForm::makeTextbox('Текст под изображением', 'text8', $bim['text8']['value']) ?>
            <?= GenerateForm::makeImageMain('Изображение 2', 'image2', $bim['image2'], $path) ?>

            <?= GenerateForm::makeTextbox('Текст 4', 'text4', $bim['text4']['value']) ?>
            <?= GenerateForm::makeTextbox('Текст 5', 'text5', $bim['text5']['value']) ?>
            <?= GenerateForm::makeTextbox('Текст 6', 'text6', $bim['text6']['value']) ?>
            <?= GenerateForm::makeTextbox('Текст 7', 'text7', $bim['text7']['value']) ?>

            <?= GenerateForm::makeGallery('Слайдер 1', 'bim_slider_1', $gallery1, $path) ?>
            <?= GenerateForm::makeGallery('Слайдер 2', 'bim_slider_2', $gallery2, $path) ?>

<!--            <fieldset>-->
<!--                <legend>Видео</legend>-->
<!--                --><?//= GenerateForm::makeImageMain('Обложка', 'image3', $bim['image3'], $path) ?>
<!---->
<!--                <div class='input_block input_file_block'>-->
<!--                    <span>Видео:</span>-->
<!--                    <input id='main_videos' type='file' name='video' accept='video/mp4'>-->
<!--                    <label for='main_videos'>Выбрать файл</label>-->
<!--                </div>-->
<!---->
<!--                --><?php //if (!empty($bim['video']['value'])): ?>
<!---->
<!--                <div class='admin_img_container'>-->
<!--                        <div class='admin_img_card'>-->
<!--                            <div class='card_image_block _transparent'>-->
<!--                                <video controls>-->
<!--                                    <source src='--><?//= $path ?><!--/--><?//= $bim['video']['value'] ?><!--' type='video/mp4'>-->
<!--                                </video>-->
<!--                            </div>-->
<!--                            <div class='img_card_panel'>-->
<!---->
<!--                                <a class='img_gallery_open' title='Открыть' target='_blank'-->
<!--                                   href='--><?//= $path ?><!--/--><?//= $bim['video']['value'] ?><!--'><i class='material-icons'>open_in_new</i></a>-->
<!---->
<!--                                <button type='button' class='bim_video_delete' data-id='--><?//= $bim['video']['id'] ?><!--'-->
<!--                                        title='Удалить'><i class='material-icons'>delete</i></button>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                </div>-->
<!--                --><?php //endif; ?>
<!---->
<!--            </fieldset>-->


            <div class='input_block'>
                <button type='submit' name='edit'>Сохранить</button>
            </div>

        </form>
    </div>

<?php endif; ?>
