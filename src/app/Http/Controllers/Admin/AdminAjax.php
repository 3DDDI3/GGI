<?php

namespace App\Http\Controllers\Admin;

use App\Events\AdminHideEvent;
use App\Helpers\FileUpload;
use App\Http\Controllers\Controller;
use App\Models\Catalog\Attributes\CatalogAttributesProducts;
use App\Models\Catalog\Attributes\CatalogAttributesValue;
use App\Models\Catalog\Chars\CatalogChars;
use App\Models\Catalog\Chars\CatalogCharsValue;
use App\Models\Discounts\Bonuses\BonusesHistory;
use App\Models\Files;
use App\Models\Gallery;
use App\Models\Reviews;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Catalog\CatalogTags;
use App\Models\Location\Storage\CatalogStorage;

class AdminAjax extends Controller
{

    public function __invoke()
    {

        if (auth()->user()->is_admin && !empty($_POST)) {

            $action = array_shift($_POST);
            call_user_func_array([$this, $action], $_POST);

        } else {
//            $error = new Error();
//            $error();
        }

        return true;
    }

    private function adminHide($id, $className, $hide)
    {
        event(new AdminHideEvent($className, $id));

        $object = $className::find($id);
        $object->hide = $hide;
        $result = $object->save();

        echo $result ? 'success' : 'error';
    }

    private function changeRating($id, $className, $value)
    {

        $value = (int)$value;

        if ($value == 0) $value = null;

        $object = $className::find($id);
        $object->rating = $value;
        $object->save();


        echo 'success';

    }

    private function changeVideoRating($id, $value)
    {

        $value = (int)$value;

        if ($value == 0) $value = null;

        if (MainVideo::find($id)->changeRating($value)) {
            echo 'success';
        } else {
            echo 'error';
        }
    }

    private function sortableRating($array, $className)
    {
        foreach ($array as $id => $rating) {
            $object = $className::find($id);
            if ($object) {
                $object->rating = (int)$rating;
                $object->save();
            }
        }
    }

    private function changeGalleryRating($id, $value)
    {

        $value = (int)$value;

        if ($value == 0) $value = null;

        $image = Gallery::find($id);

        if ($image) {

            $image->rating = $value;
            $image->save();

            echo 'success';
        } else {
            echo 'error';
        }
    }

    private function imgDelete($id, $className, $path, $field)
    {
        $image = $className::find($id);

        if ($image && !empty($image->$field)) {
            Storage::delete($image->$field);
            $image->$field = null;
            $image->save();
            echo 'success';
        } else {
            echo 'error';
        }
    }
    private function mainVideoDelete($id)
    {
        $image = MainVideo::find($id);

        if ($image && !empty($image->file)) {
            unlink(ROOT . '/upload/main_videos/' . $image->file);
            $image->delete();
            echo 'success';
        } else {
            echo 'error';
        }
    }

    private function bimVideoDelete($id)
    {
        $image = Bim::find($id);

        if ($image && !empty($image->value)) {
            unlink(ROOT . '/upload/bim/' . $image->value);
            $image->value = null;
            $image->save();
            echo 'success';
        } else {
            echo 'error';
        }
    }

    private function imgUpload()
    {
        FileUpload::editorUploadImage('file', '/storage/images/editor');
    }

    private function fileDelete($id, $className, $path, $field)
    {
        $object = $className::find($id);

        if ($object && !empty($object->$field)) {
            unlink(ROOT . $path . '/' . $object->$field);
            $object->$field = null;
            $object->save();
            echo 'success';
        } else {
            echo 'error';
        }
    }

    private function mainFileDelete($id, $className, $path)
    {
        $object = $className::find($id);

        if ($object && !empty($object->value)) {
            unlink(ROOT . $path . '/' . $object->value);
            $object->value = null;
            $object->save();
            echo 'success';
        } else {
            echo 'error';
        }
    }

    private function galleryImgDelete($id, $className, $path)
    {
        $image = $className::find($id);

        if ($image) {

//            if (!empty($image->original)) {
//                unlink(public_path() . $path . '/' . $image->original);
//            }
//
//            if (!empty($image->thumbnail)) {
//                unlink(public_path() . $path . '/' . $image->thumbnail);
//            }

            Storage::delete($image->original);

            $image->delete();

            echo 'success';
        } else {
            echo 'error';
        }
    }

    private function items_add($table, $id, $type = '') {
        switch ($table) {
            case 'catalog_attributes_value':
                $model = new CatalogAttributesValue();
                $model->name = $value ?? '';
                $model->catalog_attributes = $id;
                $model->save();
                $item_id = $model->id ?? 0;
                echo view('admin.includes.items.item', compact('item_id', 'table'));
                break;
            case 'catalog_chars_value':
                $model = new CatalogCharsValue();
                $model->name = $value ?? '';
                $model->catalog_chars = $id;
                $model->save();
                $item_id = $model->id ?? 0;
                $placeholder = 'Название';
                $placeholder2 = 'Ссылка (необязательно)';
                $second = 'link';
                $catalog_chars = CatalogChars::where('id', $id)->first();
                $field = $catalog_chars->field ?? '';
                echo view('admin.includes.items.item', compact('item_id', 'table', 'placeholder', 'second', 'placeholder2', 'field'));
                break;
            case 'catalog_attributes_products':
                $model = new CatalogAttributesProducts();
                $model->name = $value ?? '';
                $model->catalog_products = $id;
                $model->catalog_attributes = $type;
                $model->save();
                $item_id = $model->id ?? 0;
                $catalog_attributes_value = CatalogAttributesValue::list();
                $values = $catalog_attributes_value[$type] ?? array();
                echo view('admin.includes.items.item', compact('item_id', 'table', 'type', 'values'));
                break;
            case 'catalog_tags':
                $model = new CatalogTags();
                $model->name = $value ?? '';
                $model->catalog_categories = $id;
                $model->save();
                $item_id = $model->id ?? 0;
                $placeholder = 'Название';
                $placeholder2 = 'Ссылка';
                $second = 'url';
                echo view('admin.includes.items.item', compact('item_id', 'table', 'placeholder', 'second', 'placeholder2'));
                break;
        }
        return;
    }

    private function items_edit($table, $item_id, $value, $type = '') {
        switch ($table) {
            case 'catalog_attributes_value':
                $model = CatalogAttributesValue::where('id', $item_id)->first();
                if ($model) {
                    $model->name = $value ?? '';
                    $model->save();
                }
                break;
            case 'catalog_chars_value':
                $model = CatalogCharsValue::where('id', $item_id)->first();
                if ($model) {
                    $model->name = $value ?? '';
                    $model->save();
                }
                break;
            case 'catalog_attributes_products':
                $model = CatalogAttributesProducts::where('id', $item_id)->first();
                if ($model) {
                    $model->name = $value ?? '';
                    $model->save();
                }
                break;
            case 'catalog_tags':
                $model = CatalogTags::where('id', $item_id)->first();
                if ($model) {
                    $model->name = $value ?? '';
                    $model->save();
                }
                break;
        }
        return;
    }

    private function items_edit_checkbox($table, $item_id, $value, $field) {
        switch ($table) {
            case 'catalog_chars_value':
                $model = CatalogCharsValue::where('id', $item_id)->first();
                if ($model) {
                    $model->{$field} = $value ?? '';
                    $model->save();
                }
                break;
        }
        return;
    }

    private function items_edit2($table, $item_id, $value, $type = '') {
        switch ($table) {
            case 'catalog_tags':
                $model = CatalogTags::where('id', $item_id)->first();
                if ($model) {
                    $model->url = $value ?? '';
                    $model->save();
                }
                break;
            case 'catalog_chars_value':
                $model = CatalogCharsValue::where('id', $item_id)->first();
                if ($model) {
                    $model->link = $value ?? '';
                    $model->save();
                }
                break;
            case 'catalog_chars_value_brand':
                $model = CatalogCharsValue::where('id', $item_id)->first();
                if ($model) {
                    $model->show_storage_count_min = $value ?? '';
                    $model->save();
                }
                break;
        }
        return;
    }

    private function items_delete($table, $id, $type = '') {
        switch ($table) {
            case 'catalog_attributes_value':
                $model = CatalogAttributesValue::where('id', $id)->delete();
                break;
            case 'catalog_chars_value':
                $model = CatalogCharsValue::where('id', $id)->delete();
                break;
            case 'catalog_attributes_products':
                $model = CatalogAttributesProducts::where('id', $id)->delete();
                break;
            case 'catalog_tags':
                $model = CatalogTags::where('id', $id)->delete();
                break;
        }
        return;
    }

    private function accordion($name, $value) {
        if (empty($name)) return;
        $str = Str::slug($name);
        session(['accordion_'.$str => $value]);
        return;
    }

    private function changeFileRating($id, $value)
    {
        Files::find($id)->fill(['rating' => $value])->save();
    }

    private function changeFileAlt($id, $value)
    {
        Files::find($id)->fill(['name' => $value])->save();
    }

    private function deleteFile($id)
    {
        $file = Files::find($id);
        Storage::delete($file->path);
        $file->delete();
    }

    private function bonusesAccrual($count, $id , $type)
    {
        switch ($type){
            case 'review':
                $review = Reviews::find($id);
                $user_id = $review->user->id;

                $review->bonuses_count = $count;
                $review->save();

                BonusesHistory::execute('accrual', $type, $count, $user_id, $id, 'reviews');
                break;
            case 'custom_accrual':
                BonusesHistory::execute('accrual', $type, $count, $id);
        }
    }
}
