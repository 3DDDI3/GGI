<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administration extends Model
{
    use HasFactory;

    protected $table = 'administration';

    public $fillable = [
        'position',
        'position_en',
        'degree',
        'degree_en',
        'phones',
        'phones_adm',
        'phones_fax',
        'email'
    ];


}
