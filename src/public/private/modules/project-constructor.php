<?php

use App\Models\Project as Model;
use App\Models\BlogConstructor\Blocks;
use \App\Models\BlogConstructor\BlocksPosition;

use lib\GenerateForm;
use App\FileUpload;

$path = '/upload/projects';
$type = 'project';

if (isset($_POST['saveBlock'])) {

    $object = Model::findById($_POST['id']);

    if (!$object) {
        $_SESSION['notice'] = 'Такго проекта не существует';
        header('Location: /admin/projects');
        exit;
    }

    $blockPosition = BlocksPosition::findById($_POST['position_id']);

    if ($blockPosition && $blockPosition->blog_id = $object->id) {

        $blockItemClass = '\App\Models\BlogConstructor\Block_' . $blockPosition->block_id;

        if (class_exists($blockItemClass)) {

            $blockItem = $blockItemClass::findAll(['position_id' => $blockPosition->id], [], 1);

            if ($blockItem) {
                switch ($blockPosition->block_id) {
                    case 1:
                        $blockItem->text = $_POST['text'];
                        $blockItem->save();
                        break;
                    case 2:
                        $blockItem->text1 = $_POST['text1'];
                        $blockItem->text2 = $_POST['text2'];
                        $blockItem->share_show = 0;
                        $blockItem->save();
                        break;
                    case 3:
                        FileUpload::uploadImage('image1', get_class($blockItem), 'image1', $blockItem->id, 1920, 1280, $path);
                        break;
                    case 4:
                        FileUpload::uploadImage('image1', get_class($blockItem), 'image1', $blockItem->id, 720, 1080, $path);
                        FileUpload::uploadImage('image2', get_class($blockItem), 'image2', $blockItem->id, 720, 1080, $path);
                        break;
                }
            }
        }
    }

    $_SESSION['notice'] = 'Изменено';
    header('Location: /admin/project-constructor?editBlock&id=' . $object->id . '&position_id=' . $blockPosition->id);
    exit;
}

if (isset($_GET['id']) && !empty($_GET['id'])):

    $object = Model::findById($_GET['id']);

    if (!$object) {
        $_SESSION['notice'] = 'Такго проекта не существует';
        header('Location: /admin/projects');
        exit;
    }

    if (isset($_GET['addBlock'])) {

        if (Blocks::findById($_GET['block_id'])) {
            $blockPosition = new BlocksPosition();
            $blockPosition->block_id = $_GET['block_id'];
            $blockPosition->blog_id = $object->id;
            $blockPosition->type = $type;
            $blockPosition->hide = 0;
            $blockPosition->save();

            $blockItemClass = '\App\Models\BlogConstructor\Block_' . $_GET['block_id'];
            $blockItem = new $blockItemClass;
            $blockItem->position_id = $blockPosition->id;
            $blockItem->save();

            $_SESSION['notice'] = 'Добавлено';
        } else {
            $_SESSION['notice'] = 'Блок с таким id не существует';
        }
        header('Location: /admin/project-constructor?id=' . $object->id);
        exit;

    } elseif (isset($_GET['deleteBlock'])) {

        $blockPosition = BlocksPosition::findById($_GET['position_id']);

        if ($blockPosition && $blockPosition->blog_id = $object->id) {

            $blockItemClass = '\App\Models\BlogConstructor\Block_' . $blockPosition->block_id;

            if (class_exists($blockItemClass)) {

                $blockItem = $blockItemClass::findAll(['position_id' => $blockPosition->id], [], 1);

                if ($blockItem) {
                    if (isset($blockItem->image1) && !empty($blockItem->image1)) {
                        unlink(ROOT . $path . '/' . $blockItem->image1);
                    }
                    if (isset($blockItem->image2) && !empty($blockItem->image2)) {
                        unlink(ROOT . $path . '/' . $blockItem->image2);
                    }
                    $blockItem->delete();
                }
            }

            $blockPosition->delete();
            $_SESSION['notice'] = 'Удалено';
        } else {
            $_SESSION['notice'] = 'Ошибка';
        }

        header('Location: /admin/project-constructor?id=' . $object->id);
        exit;

    } elseif (isset($_GET['editBlock'])) {

        $blockPosition = BlocksPosition::findById($_GET['position_id']);

        if ($blockPosition && $blockPosition->blog_id = $object->id) {

            $blockItemClass = '\App\Models\BlogConstructor\Block_' . $blockPosition->block_id;

            if (class_exists($blockItemClass)) {

                $blockItem = $blockItemClass::findAll(['position_id' => $blockPosition->id], [], 1);

                if ($blockItem) { ?>

                    <div class='admin_edit-links'>
                        <a href='/<?= URI ?>?id=<?= $object->id ?>'>Назад</a>
                    </div>

                    <form action='/<?= URI ?>' method='post' class='admin_edit-form' enctype='multipart/form-data'>
                        <?php switch ($blockPosition->block_id):
                            case 1:
                                echo GenerateForm::makeTextbox('Текст', 'text', $blockItem->text);
                                break;
                            case 2:
                                echo GenerateForm::makeTextbox('Текст слева', 'text1', $blockItem->text1);
                                echo GenerateForm::makeTextbox('Текст справа', 'text2', $blockItem->text2);
                                break;
                            case 3:
                                echo GenerateForm::makeImage('Изображение (1920x1280)', 'image1', $blockItem, $path);
                                break;
                            case 4:
                                echo GenerateForm::makeImage('Изображение слева (720x1080)', 'image1', $blockItem, $path);
                                echo GenerateForm::makeImage('Изображение справа (720x1080)', 'image2', $blockItem, $path);
                                break;
                        endswitch; ?>

                        <input type='hidden' name='id' value='<?= $object->id ?>'>
                        <input type='hidden' name='position_id' value='<?= $blockPosition->id ?>'>
                        <div class='input_block'>
                            <button type='submit' name='saveBlock'>Сохранить</button>
                        </div>
                    </form>
                    <?php
                }
            }
        }

    } else {

        $blocks = Blocks::findAll();
        $pageBlocks = BlocksPosition::getBlocks($object->id, $type); ?>

        <h1>Содежримое проекта: <?= $object->name ?></h1>

        <div class='admin_edit_block'>

            <div class='admin_edit-links'>
                <a href='/admin/projects'>Назад к списку</a>
                <a href='/project/<?= $object->url ?>' target='_blank'>Посмотреть на сайте</a>
            </div>

            <div class='constructor_add_links'>
                <?php foreach ($blocks as $addLink): ?>
                    <a href='?addBlock&id=<?= $object->id ?>&block_id=<?= $addLink->id ?>'
                       class='admin_add'>Добавить <?= $addLink->name ?></a>
                <?php endforeach; ?>
            </div>

            <?php if (!empty($pageBlocks)): ?>
                <div class='module-help'>
                    <i class='material-icons'>sort_by_alpha</i>
                    <span>В этом модуле доступно изменение порядка материалов. Используйте перетаскивание мышью для сортировки.</span>
                </div>
                <div class='sortable_list'>
                    <?php foreach ($pageBlocks as $pageBlock): ?>
                        <div class='list_item'>
                            <div class='list_item-info'>
                                <h4><?= $pageBlock->name ?></h4>
                            </div>
                            <div class='list_item-actions'>
                                <input type='text' class='rating-change' value='<?= $pageBlock->rating ?>'
                                       data-id='<?= $pageBlock->id ?>'
                                       data-class='<?= get_class($pageBlock) ?>' placeholder='Рейтинг'>
                                <div class='admin_show <?= ($pageBlock->hide == 0) ? 'admin_show_act' : '' ?>'
                                     title='Показывать' data-id='<?= $pageBlock->id ?>'
                                     data-class='<?= get_class($pageBlock) ?>'></div>
                                <a href='?editBlock&id=<?= $object->id ?>&position_id=<?= $pageBlock->id ?>'
                                   class='admin_edit'
                                   title='Редактировать'></a>
                                <a href='?deleteBlock&id=<?= $object->id ?>&position_id=<?= $pageBlock->id ?>'
                                   class='admin_delete'
                                   title='Удалить'></a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class='not_found'>Ничего не найдено</div>
            <?php endif; ?>
        </div>

    <?php }
else:
    $_SESSION['notice'] = 'Такого проекта не существует';
    header('Location: /admin/projects');
    exit;
endif;
