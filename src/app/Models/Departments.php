<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    use HasFactory;

    protected $table = 'departments';

    public $fillable = [
        'parent_id'
    ];

    public function content()
    {
        return $this->hasOne(Content::class, 'item_id')->where('type', 'departments');
    }

}
