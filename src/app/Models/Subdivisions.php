<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdivisions extends Model
{
    use HasFactory;

    protected $table = 'subdivisions';

    public $fillable = [
        'hide',
        'name',
        'name_en',
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
