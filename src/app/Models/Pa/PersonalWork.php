<?php

namespace App\Models\Pa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalWork extends Model
{
    use HasFactory;

    protected $table = "personal_works";

    protected $fillable = [
        'year',
        'topic',
        'post',
        'acount_id',
        'scientific_degree',
        'scientific_head'
    ];
}
