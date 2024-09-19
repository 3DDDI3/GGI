<?php

namespace App\Helpers;


class GenerateForm
{

    public static function makeInput($title, $name, $value, $required = false, $type = 'text')
    {
        include public_path('/private/views/templates/input.php');
        return self::getHtml();
    }

    public static function makeSubmit($id, $value = 1, $text = 'Отправить')
    {
        include public_path('/private/views/templates/submit.php');
        return self::getHtml();
    }

    public static function makeCheckbox($name, $checked, $title = 'Показывать на сайте', $value = 1, $id = null)
    {
        include public_path('/private/views/templates/checkbox.php');
        return self::getHtml();
    }

    public static function makeMultipleCheckbox($name, $checked, $title = 'Показывать на сайте', $value = 1, $id = null, $key = null)
    {
        include public_path('/private/views/templates/checkboxMultiple.php');
        return self::getHtml();
    }

    public static function makeRadio($title, $name, $items = [], $checked = null)
    {
        include public_path('/private/views/templates/radio.php');
        return self::getHtml();
    }

    public static function makeTextarea($title, $name, $value)
    {
        include public_path('/private/views/templates/textarea.php');
        return self::getHtml();
    }

    public static function makeImage($title, $name, $object, $path, $required = false , $name2 = null)
    {
        include public_path('/private/views/templates/image.php');
        return self::getHtml();
    }

    public static function makeFile($title, $name, $object, $path, $required = false, $accept = '', $field = false)
    {
        include public_path('/private/views/templates/file.php');
        return self::getHtml();
    }

    public static function makeGallery($title, $name, $images, $path)
    {
        include public_path('/private/views/templates/gallery.php');
        return self::getHtml();
    }

    public static function makeTextbox($title, $name, $value)
    {
        include public_path('/private/views/templates/textbox.php');
        return self::getHtml();
    }

    public static function makeComponent($title, $name, $object, $selected)
    {
        include public_path('/private/views/templates/component.php');
        return self::getHtml();
    }

    public static function makeSelect($title, $name, $object, $selectedId = null, $null = true, $nullTitle = 'Нет')
    {
        include public_path('/private/views/templates/select.php');
        return self::getHtml();
    }

    public static function makeMultipleSelect($title, $name, $object, $selected = [], $info = 'Для множественного выбора зажмите клавишу ctrl')
    {
        include public_path('/private/views/templates/selectMultiple.php');
        return self::getHtml();
    }

    public static function makeImageMain($title, $name, $object, $path, $required = false)
    {
        include public_path('/private/views/templates/imageMain.php');
        return self::getHtml();
    }


    public static function getHtml()
    {
        $html = ob_get_contents();
        ob_clean();

        return $html;
    }

}
