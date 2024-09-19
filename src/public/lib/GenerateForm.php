<?php

namespace lib;


class GenerateForm
{

    public static function makeInput($title, $name, $value, $required = false, $type = 'text')
    {
        include ROOT . '/private/views/templates/input.php';
        return self::getHtml();
    }

    public static function makeSubmit($id, $value = 1, $text = 'Отправить')
    {
        include ROOT . '/private/views/templates/submit.php';
        return self::getHtml();
    }

    public static function makeCheckbox($name, $checked, $title = 'Показывать на сайте', $value = 1, $id = null)
    {
        include ROOT . '/private/views/templates/checkbox.php';
        return self::getHtml();
    }

    public static function makeMultipleCheckbox($name, $checked, $title = 'Показывать на сайте', $value = 1, $id = null, $key = null)
    {
        include ROOT . '/private/views/templates/checkboxMultiple.php';
        return self::getHtml();
    }

    public static function makeRadio($title, $name, $items = [], $checked = null)
    {
        include ROOT . '/private/views/templates/radio.php';
        return self::getHtml();
    }

    public static function makeTextarea($title, $name, $value)
    {
        include ROOT . '/private/views/templates/textarea.php';
        return self::getHtml();
    }

    public static function makeImage($title, $name, $object, $path, $required = false)
    {
        include ROOT . '/private/views/templates/image.php';
        return self::getHtml();
    }

    public static function makeFile($title, $name, $object, $path, $required = false, $accept = '', $field = false)
    {
        include ROOT . '/private/views/templates/file.php';
        return self::getHtml();
    }

    public static function makeGallery($title, $name, $images, $path)
    {
        include ROOT . '/private/views/templates/gallery.php';
        return self::getHtml();
    }

    public static function makeTextbox($title, $name, $value)
    {
        include ROOT . '/private/views/templates/textbox.php';
        return self::getHtml();
    }

    public static function makeComponent($title, $name, $object, $selected)
    {
        include ROOT . '/private/views/templates/component.php';
        return self::getHtml();
    }

    public static function makeSelect($title, $name, $object, $selectedId = null, $null = true, $nullTitle = 'Нет')
    {
        include ROOT . '/private/views/templates/select.php';
        return self::getHtml();
    }

    public static function makeMultipleSelect($title, $name, $object, $selected = [], $info = 'Для множественного выбора зажмите клавишу ctrl')
    {
        include ROOT . '/private/views/templates/selectMultiple.php';
        return self::getHtml();
    }

    public static function makeImageMain($title, $name, $object, $path, $required = false)
    {
        include ROOT . '/private/views/templates/imageMain.php';
        return self::getHtml();
    }

    public static function getHtml()
    {
        $html = ob_get_contents();
        ob_clean();

        return $html;
    }

}