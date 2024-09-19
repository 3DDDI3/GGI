<?php

namespace App\Models\Pa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcountType extends Model
{
    use HasFactory;

    protected $table = 'acount_types';

    protected $fillable = [
        'type',
    ];
}
