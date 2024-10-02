<?php

namespace App\Helpers;

//use App\Models\Bim;
//use App\Models\MainVideo;
use App\Models\Files;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use App\Models\Gallery;
use mysql_xdevapi\Exception;

class FileUpload
{
    // Массив с названиями ошибок
    private static $errorMessages = [
        UPLOAD_ERR_INI_SIZE => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP.',
        UPLOAD_ERR_FORM_SIZE => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме.',
        UPLOAD_ERR_PARTIAL => 'Загружаемый файл был получен только частично.',
        UPLOAD_ERR_NO_FILE => 'Файл не был загружен.',
        UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
        UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.',
        UPLOAD_ERR_EXTENSION => 'PHP-расширение остановило загрузку файла.',
    ];

    // Зададим неизвестную ошибку
    private static $unknownMessage = 'При загрузке файла произошла неизвестная ошибка.';

    private static $maxFileSize = 10;

    public static function changeStructure($inputName)
    {
        // Изменим структуру $_FILES
        foreach ($_FILES[$inputName] as $key => $value) {
            foreach ($value as $k => $v) {
                $_FILES[$inputName][$k][$key] = $v;
            }
            // Удалим старые ключи
            unset($_FILES[$inputName][$key]);
        }
    }

    public static function uploadGallery($inputName, $item_id, $item_type, $smallWidth = null, $smallHeight = null, $path = '/upload', $structure = false, $request = null)
    {

        if (!$structure) {
            self::changeStructure($inputName);
        }

        $limitBytes = 1024 * 1024 * self::$maxFileSize;

        $files =  $request->file($inputName);

        if (empty($files)) return;

        // Загружаем все картинки по порядку
        foreach ($files as $k => $v) {

            if (!$v) continue;

            if ($v->getSize() > $limitBytes) die('Размер изображения не должен превышать ' . self::$maxFileSize . ' Мбайт.');

            try {
                $serverPath = $v->store($path);
            } catch (\Exception $e) {
                continue;
            }

            $galleryImg = new Gallery();

            $galleryImg->original = $serverPath;

            $galleryImg->thumbnail = null;

            if (!empty($smallWidth) || !empty($smallHeight)) {

                $smallName = explode('.', $serverPath);
                $smallName[0] .= '_small';
                $smallName = implode('.', $smallName);

                $galleryImg->thumbnail = $smallName;

                $manager = new ImageManager(['driver' => 'gd']);
                $manager
                    ->make('storage/' . $serverPath)
                    ->resize($smallWidth, $smallHeight, function ($img) {
                        $img->aspectRatio();
                        $img->upsize();
                    })
                    ->save('storage/' . $smallName, 100);
            }

            $galleryImg->alt = null;
            $galleryImg->file_name  = $serverPath;
            $galleryImg->rating = null;
            $galleryImg->item_type = $item_type;
            $galleryImg->item_id = $item_id;

            $galleryImg->save();
        }
    }

    public static function uploadFileMultiple($inputName, $path = '/upload')
    {
        self::$maxFileSize = 150;
        self::changeStructure($inputName);

        // Загружаем все картинки по порядку
        foreach ($_FILES[$inputName] as $k => $v) {


            // Загружаем по одному файлу
            $filePath = $_FILES[$inputName][$k]['tmp_name'];
            $errorCode = $_FILES[$inputName][$k]['error'];
            $fileName = $_FILES[$inputName][$k]['name'];

            // Проверим на ошибки
            if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($filePath)) {
                $outputMessage = isset(self::$errorMessages[$errorCode]) ? self::$errorMessages[$errorCode] : self::$unknownMessage;
                continue;
            }

            $limitBytes = 1024 * 1024 * self::$maxFileSize;
            if (filesize($filePath) > $limitBytes) die('Размер файла не должен превышать ' . self::$maxFileSize . ' Мбайт.');

            $serverPath = public_path() . $path . '/' . $fileName;

            // Переместим картинку с новым именем и расширением в папку
            if (!move_uploaded_file($filePath, $serverPath)) {
                die('При записи файла на диск произошла ошибка.');
            }

            $object = new MainVideo();
            $object->file = $fileName;
            $object->save();
        }
    }

    public static function uploadImage($inputName, $class, $field, $id, $width, $height, $path = '/storage', $webp = false, Request $request = null)
    {

        $filePath = $_FILES[$inputName]['tmp_name'];
        $errorCode = $_FILES[$inputName]['error'];


        // Проверим на ошибки
        if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($filePath)) {
            // Если в массиве нет кода ошибки, скажем, что ошибка неизвестна
            $outputMessage = isset(self::$errorMessages[$errorCode]) ? self::$errorMessages[$errorCode] : self::$unknownMessage;

            // Выведем название ошибки
            // die($outputMessage);
            return;
        }

        // Создадим ресурс FileInfo
        $fi = finfo_open(FILEINFO_MIME_TYPE);

        // Получим MIME-тип
        $mime = (string)finfo_file($fi, $filePath);

        // Проверим ключевое слово image (image/jpeg, image/png и т. д.)
        if (strpos($mime, 'image') === false) die('Можно загружать только изображения.');

        // Результат функции запишем в переменную
        $image = getimagesize($filePath);

        // Зададим ограничения для картинок
        $limitBytes = 1024 * 1024 * self::$maxFileSize;

        // Проверим нужные параметры
        if (filesize($filePath) > $limitBytes) die('Размер изображения не должен превышать ' . self::$maxFileSize . ' Мбайт.');

        $serverPath =  $request->file($inputName)->store($path);
        if (!empty($width) || !empty($height)) {
            $arrPath = explode('.', $serverPath);

            if ($arrPath[sizeof($arrPath) - 1] != 'svg') {
                $manager = new ImageManager(['driver' => 'gd']);

                if ($webp) {
                    $manager
                        ->make(storage_path($serverPath))
                        ->encode('webp')
                        ->resize($width, $height, function ($img) {
                            $img->aspectRatio();
                            $img->upsize();
                        })->save($serverPath, 100, 'webp');
                } else {
                    $manager
                        ->make('storage/' . $serverPath)
                        ->resize($width, $height, function ($img) {
                            $img->aspectRatio();
                            $img->upsize();
                        })->save();
                }
            }
        }

        self::addToDb($id, $class, $field, $path, $serverPath);
    }

    public static function editorUploadImage($inputName, $path = '/storage/images/editor')
    {

        $filePath = $_FILES[$inputName]['tmp_name'];
        $errorCode = $_FILES[$inputName]['error'];

        // Проверим на ошибки
        if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($filePath)) {
            // Если в массиве нет кода ошибки, скажем, что ошибка неизвестна
            $outputMessage = isset(self::$errorMessages[$errorCode]) ? self::$errorMessages[$errorCode] : self::$unknownMessage;

            // Выведем название ошибки
            // die($outputMessage);
            return;
        }

        // Создадим ресурс FileInfo
        $fi = finfo_open(FILEINFO_MIME_TYPE);

        // Получим MIME-тип
        $mime = (string)finfo_file($fi, $filePath);

        // Проверим ключевое слово image (image/jpeg, image/png и т. д.)
        if (strpos($mime, 'image') === false) die('Можно загружать только изображения.');

        // Результат функции запишем в переменную
        $image = getimagesize($filePath);

        // Зададим ограничения для картинок
        $limitBytes = 1024 * 1024 * self::$maxFileSize;

        // Проверим нужные параметры
        if (filesize($filePath) > $limitBytes) die('Размер изображения не должен превышать ' . self::$maxFileSize . ' Мбайт.');

        // Сгенерируем новое имя файла на основе MD5-хеша
        $name = uniqid();

        // Сгенерируем расширение файла на основе типа картинки
        $extension = image_type_to_extension($image[2]);

        // Сократим .jpeg до .jpg
        $format = str_replace('jpeg', 'jpg', $extension);

        $src = $path . '/' . $name . $format;
        $serverPath = public_path() . $src;

        // Переместим картинку с новым именем и расширением в папку
        if (!move_uploaded_file($filePath, $serverPath)) {
            die('При записи изображения на диск произошла ошибка.');
        }

        echo $src;
    }

    public static function uploadFile($inputName, $class, $field, $id, $path = '/files')
    {

        self::$maxFileSize = 150;

        $filePath = $_FILES[$inputName]['tmp_name'];
        $errorCode = $_FILES[$inputName]['error'];
        $fileName = $_FILES[$inputName]['name'];

        // Проверим на ошибки
        if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($filePath)) {

            // Если в массиве нет кода ошибки, скажем, что ошибка неизвестна
            $outputMessage = isset(self::$errorMessages[$errorCode]) ? self::$errorMessages[$errorCode] : self::$unknownMessage;

            // Выведем название ошибки
            return;
        }

        $limitBytes = 1024 * 1024 * self::$maxFileSize;

        // Проверим нужные параметры
        if (filesize($filePath) > $limitBytes) die('Размер файла не должен превышать ' . self::$maxFileSize . ' Мбайт.');

        // Сгенерируем новое имя файла на основе MD5-хеша

        $name = uniqid();
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        $serverPath = public_path() . "/storage" . $path . $name . "." . $extension;

        //  $serverPath = public_path() .'/storage'.$path . '/' . $fileName;

        // Переместим картинку с новым именем и расширением в папку
        if (!move_uploaded_file($filePath, $serverPath)) {
            die('При записи файла на диск произошла ошибка.');
        }

        self::addToDb($id, $class, $field, $path, $path . "{$name}.{$extension}");
    }

    public static function uploadFileMain($inputName, $path = '/upload')
    {

        self::$maxFileSize = 150;
        $filePath = $_FILES[$inputName]['tmp_name'];
        $errorCode = $_FILES[$inputName]['error'];
        $fileName = $_FILES[$inputName]['name'];

        if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($filePath)) {
            $outputMessage = isset(self::$errorMessages[$errorCode]) ? self::$errorMessages[$errorCode] : self::$unknownMessage;
            return;
        }

        $limitBytes = 1024 * 1024 * self::$maxFileSize;

        // Проверим нужные параметры
        if (filesize($filePath) > $limitBytes) die('Размер файла не должен превышать ' . self::$maxFileSize . ' Мбайт.');

        $serverPath = public_path() . $path . '/' . $fileName;

        if (!move_uploaded_file($filePath, $serverPath)) {
            die('При записи файла на диск произошла ошибка.');
        }

        $mainObject = Bim::findByName($inputName);
        if (!empty($mainObject->value)) {
            unlink(public_path() . $path . '/' . $mainObject->value);
        }
        $mainObject->value = $fileName;
        $mainObject->save();
    }

    public static function uploadImageMain($inputName, $width, $height, $path = '/upload')
    {

        $filePath = $_FILES[$inputName]['tmp_name'];
        $errorCode = $_FILES[$inputName]['error'];

        // Проверим на ошибки
        if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($filePath)) {
            // Если в массиве нет кода ошибки, скажем, что ошибка неизвестна
            $outputMessage = isset(self::$errorMessages[$errorCode]) ? self::$errorMessages[$errorCode] : self::$unknownMessage;

            // Выведем название ошибки
            // die($outputMessage);
            return;
        }

        // Создадим ресурс FileInfo
        $fi = finfo_open(FILEINFO_MIME_TYPE);

        // Получим MIME-тип
        $mime = (string)finfo_file($fi, $filePath);

        // Проверим ключевое слово image (image/jpeg, image/png и т. д.)
        if (strpos($mime, 'image') === false) die('Можно загружать только изображения.');

        // Результат функции запишем в переменную
        $image = getimagesize($filePath);

        // Зададим ограничения для картинок
        $limitBytes = 1024 * 1024 * self::$maxFileSize;

        // Проверим нужные параметры
        if (filesize($filePath) > $limitBytes) die('Размер изображения не должен превышать ' . self::$maxFileSize . ' Мбайт.');

        // Сгенерируем новое имя файла на основе MD5-хеша
        $name = uniqid();

        // Сгенерируем расширение файла на основе типа картинки
        $extension = image_type_to_extension($image[2]);

        // Сократим .jpeg до .jpg
        $format = str_replace('jpeg', 'jpg', $extension);

        $serverPath = public_path() . $path . '/' . $name . $format;

        // Переместим картинку с новым именем и расширением в папку
        if (!move_uploaded_file($filePath, $serverPath)) {
            die('При записи изображения на диск произошла ошибка.');
        }

        if (!empty($width) || !empty($height)) {

            $manager = new ImageManager(['driver' => 'gd']);

            $manager
                ->make($serverPath)
                ->resize($width, $height, function ($img) {
                    $img->aspectRatio();
                    $img->upsize();
                })
                ->save();
        }

        $mainObject = Bim::findByName($inputName);
        if (!empty($mainObject->value)) {
            unlink(public_path() . $path . '/' . $mainObject->value);
        }
        $mainObject->value = $name . $format;
        $mainObject->save();
    }

    public static function uploadFiles($request, $name, $path, $item_id, $item_type)
    {
        $files = $request->file($name);


        if (!empty($files)) {
            foreach ($files as $value) {
                $file_data = new Files();
                $file_data->path = $value->store($path);
                $file_data->item_id = $item_id;
                $file_data->item_type = $item_type;
                $file_data->save();
            }
        }
    }

    private static function addToDb($id, $class, $field, $path, $file)
    {


        $object = $class::find($id);

        if (!empty($object->$field)) {
            try {
                unlink(public_path() . $path . '/' . $object->$field);
            } catch (\Exception $e) {
                //
            }
        }

        $object->$field = $file;


        $object->save();
    }
}
