<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publications extends Model
{
    use HasFactory;

    protected $table = 'publications';

    public $fillable = [
        'hide',
        'rating',
        'image',
        'name',
        'name_en',
        'text',
        'text_en',
        'path'
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