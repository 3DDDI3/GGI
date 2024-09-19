<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffDef extends Model
{
    use HasFactory;

    protected $table = 'staff_dep';

    public $fillable = [
        'id_staff',
        'id_dep'
    ];
}
?>