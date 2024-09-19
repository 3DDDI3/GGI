<?php

use App\FileUpload;
use App\Models\Settings;
use lib\GenerateForm;

$title = 'Настройки';
$add = false;
$filter = false;

$path = '/upload';

if (isset($_POST['edit'])):

    unset($_POST['edit']);

    foreach ($_POST as $name => $value) {
        $setting = Settings::findAll(['name' => $name], [], 1);
        $setting->value = $value;
        $setting->save();
    }

//    $catalog = Settings::findAll(['name' => 'catalog'], [], 1);
//    FileUpload::uploadFile($catalog->name, get_class($catalog), 'value', $catalog->id, $path);


    $_SESSION['notice'] = 'Изменено';

    header("Location: {$_SERVER['REQUEST_URI']}");
    exit;

else:

    $settingsGroup = [];
    $settings = Settings::findAll(['hide' => 0], ['rating' => 'DESC', 'id' => 'ASC']);

    foreach ($settings as $key => $setting) {
        if ($setting->group != null) {
            $settingsGroup[$setting->group][] = $setting;
            unset($settings[$key]);
        }
    }

    include ROOT . '/private/views/panel_header.php'; ?>

    <div class='admin_edit_block'>
        <form action='<?= $_SERVER['REQUEST_URI'] ?>' method='post' class='admin_edit-form' enctype='multipart/form-data'>

            <?php foreach ($settingsGroup as $title => $settingArray): ?>
                <fieldset>
                    <legend><?= $title ?>:</legend>

                    <?php foreach ($settingArray as $setting): ?>
                        <div class='input_block'>
                            <span><?= $setting->title ?>:</span>
                            <?php switch ($setting->type):
                                case 'input': ?>
                                    <input type='text' name='<?= $setting->name ?>' value='<?= $setting->value ?>'>
                                    <?php break;
                                case 'textarea': ?>
                                    <textarea name='<?= $setting->name ?>'><?= $setting->value ?></textarea>
                                    <?php break;
                                case 'textbox': ?>
                                    <textarea name='<?= $setting->name ?>' class='editor' id='editor_<?= $setting->name ?>'><?= $setting->value ?></textarea>
                                    <?php break;
                            endswitch; ?>
                        </div>
                    <?php endforeach; ?>

                </fieldset>
            <?php endforeach; ?>

            <?php foreach ($settings as $setting): ?>
                <div class='input_block'>
                    <span><?= $setting->title ?>:</span>
                    <?php switch ($setting->type):
                        case 'input': ?>
                            <input type='text' name='<?= $setting->name ?>' value='<?= $setting->value ?>'>
                            <?php break;
                        case 'textarea': ?>
                            <textarea name='<?= $setting->name ?>'><?= $setting->value ?></textarea>
                            <?php break;
                        case 'textbox': ?>
                            <textarea name='<?= $setting->name ?>' class='editor' id='editor_<?= $setting->name ?>'><?= $setting->value ?></textarea>
                            <?php break;
                        case 'file':
                            echo  GenerateForm::makeFile('', $setting->name, $setting, $path, false, '', 'value');
                            break;
                    endswitch; ?>
                </div>
            <?php endforeach; ?>

            <div class='input_block'>
                <button type='submit' name='edit'>Сохранить</button>
            </div>

        </form>
    </div>

<?php endif; ?>
