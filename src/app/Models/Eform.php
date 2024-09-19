<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eform extends Model
{
    use HasFactory;

    protected $table = 'eform';

    public $fillable = [
        'name1',
        'name2',
        'name3',
        'email',

        'organisation',
        'position',
        'zipcode',
        'region',
        'city',
        'address',
        'text',
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