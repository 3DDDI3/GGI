<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gallery;

class InstituteObjects extends Model
{
    use HasFactory;

    protected $table = 'institute_objects';

    public $fillable = [
        'hide',
        'coordinates',
        'text',
        'text_en',
        'location',
        'title',
        'location_en',
        'title_en',
        'rating'
    ];

    public static function getList()
    {
        return self::query()
            ->where('hide', 0)
            ->orderBy('rating', 'desc')
            ->orderBy('id', 'desc')
            ->get();
    }

}
