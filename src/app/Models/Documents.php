<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    use HasFactory;

    protected $table = 'documents';

    public $fillable = [
        'hide',
        'name',
        'name_en',
        'path',
        'rating'
    ];

}
