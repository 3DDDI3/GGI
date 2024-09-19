<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gallery;

class Courses extends Model
{
    use HasFactory;

    protected $table = 'courses';

    public $fillable = [
        'text_1',
        'text_1_en',
        'text_2',
        'text_2_en',
        'text_3',
        'text_3_en',
        'text_4',
        'text_4_en',
        'additional_information',
        'additional_information_en'
    ];

    public function gallery()
    {
        return $this->hasMany(Gallery::class, 'item_id')->where('item_type', 'courses');
    }

}
