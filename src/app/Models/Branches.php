<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gallery;


class Branches extends Model
{
    use HasFactory;

    protected $table = 'branches';

    public $fillable = [
        'hide',
        'name',
        'name_en',
        'description',
        'description_en',
        'phone',
        'fax',
        'email',
        'address',
        'coordinates',
        'image',
        'text',
        'text_en',
        'text2',
        'text2_en',
        'rating',
        
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
