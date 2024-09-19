<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Db;

class Files extends Model
{
    protected $table = 'files';

    public $fillable = [
      'name',
      'rating',
      'item_id',
      'item_type',
      'path'
    ];

    public static function getFile($item_type, $item_id = null)
    {
        $query = self::where('item_type' , $item_type);
        if ($item_id) $query = $query->where('item_id' , $item_id);
        return $query->orderBy('rating' , 'desc')->get();
    }

    public static function deleteFile($item_id, $item_type, $path)
    {
        $files = self::getFile($item_id, $item_type);

        foreach ($files as $file) {
            if (!empty($file->path))
                unlink($_SERVER['DOCUMENT_ROOT'] . $path );
            $file->delete();
        }
    }

}
