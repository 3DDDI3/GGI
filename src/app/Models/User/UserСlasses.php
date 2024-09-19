<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserСlasses extends Model
{
    protected $table = 'users_classes';

    public $fillable = [
        'name'
    ];

    public function rights()
    {
        return $this->hasMany(AdminAccessRights::class, 'user_class_id');
    }
}
