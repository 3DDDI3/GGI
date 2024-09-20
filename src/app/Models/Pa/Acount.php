<?php

namespace App\Models\Pa;

use App\Http\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Acount extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $table = "acounts";

    protected $fillable = [
        'lastName',
        'firstName',
        'secondName',
        'email',
        'password',
        'birthday',
        'specialty',
        'study_place',
        'icon',
        'passport',
        'inn',
        'snils',
    ];

    protected $casts = [
        'birthday' => 'datetime',
    ];
}
