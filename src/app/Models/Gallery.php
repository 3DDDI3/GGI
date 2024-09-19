<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Db;

class Gallery extends Model
{
    protected $table = 'gallery';
    public $timestamps = false;

    public static function getGallery($item_type, $item_id = null)
    {
//        $db = new Db();
//        $sql = 'SELECT * FROM ' . self::$table . ' WHERE `item_type` = :item_type';
//        $data = [':item_type' => $item_type];
//
//        if ($item_id) {
//            $sql .= ' AND `item_id` = :item_id';
//            $data[':item_id'] = $item_id;
//        }
//
//        $sql .= ' ORDER BY `rating` DESC, id ASC';
//
//        return $db->query(
//            $sql, $data, static::class
//        );
        $query = self::where('item_type' , $item_type);
        if ($item_id) $query = $query->where('item_id' , $item_id);
        return $query->orderBy('rating' , 'desc')->get();
    }

    public static function deleteGallery($item_id, $item_type, $path)
    {
        $gallery = self::getGallery($item_id, $item_type);

        foreach ($gallery as $image) {

            if (!empty($image->original)) {
                unlink($_SERVER['DOCUMENT_ROOT'] . $path . '/' . $image->original);
            }

            if (!empty($image->thumbnail)) {
                unlink($_SERVER['DOCUMENT_ROOT']. $path . '/' . $image->thumbnail);
            }

            $image->delete();
        }

    }

}
