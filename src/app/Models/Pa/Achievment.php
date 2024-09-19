<?php

namespace App\Models\Pa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievment extends Model
{
    use HasFactory;

    protected $table = "achievments";

    protected $fillable = [
        'diploma',
        'report',
        'other'
    ];
}
