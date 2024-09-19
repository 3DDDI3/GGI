<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Council extends Model
{
    use HasFactory;

    protected $table = 'council';

    public $fillable = [
        'name',
        'name_en',
        'text',
        'text_en',
        'rating',
        'hide',
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