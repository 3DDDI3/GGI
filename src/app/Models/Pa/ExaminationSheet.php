<?php

namespace App\Models\Pa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExaminationSheet extends Model
{
    use HasFactory;

    protected $table = "achievments";

    protected $fillable = [
        'acount_id',
        'diploma',
        'report',
        'other',
    ];
}
