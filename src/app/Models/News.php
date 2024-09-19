<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gallery;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    public $fillable = [
        'main_page_hide',
        'name2',
        'name2_en',
        'preview_text',
        'preview_text_en'
    ];

    public function gallery()
    {
        return $this->hasMany(Gallery::class, 'item_id')->where('item_type', 'news');
    }

}
