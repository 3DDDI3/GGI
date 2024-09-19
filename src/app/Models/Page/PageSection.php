<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    use HasFactory;

    protected $table = 'page_sections';

    public $fillable = [
        'name',
        'hide',
        'rating'
    ];

    public function pages()
    {
        return $this->hasMany(Page::class, 'section_id');
    }

    public static function getList()
    {
        return self::query()
            ->where('hide', '<>', 1)
            ->with(['pages' => function($query){
                $query
                    ->where('hide', '<>', '1')
                    ->orderBy('rating', 'desc')
                    ->orderBy('id', 'asc');
            }])
            ->get();
    }
}
