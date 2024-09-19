<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Files;

class Pages extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'pages';

    public $fillable = [
        'name' ,
        'name_en',
        'url',
        'section_id',
        'footer_hide',
        'header_hide',
        'rating',
        'text',
        'text_en',
        'text_2',
        'text_2_en',
        'text_3',
        'text_3_en',
        'text_4',
        'text_4_en',
        'text_5',
        'text_5_en',
        'text_6',
        'text_6_en',
        'text_7',
        'text_7_en',
        'text_8',
        'text_8_en',
        'text_9',
        'text_9_en',
        'text_10',
        'text_10_en',
        'text_11',
        'text_11_en',
        'text_12',
        'text_12_en',
        'text_13',
        'text_13_en',
        'text_14',
        'text_14_en',
        'text_15',
        'text_15_en',
        'image',
        'image_2',
        'image_3',
        'image_4',
        'image_5',
        'file',
        'file_2',
        'file_3',
        'file_4',
        'file_5'
    ];


    public static $headerFooterFields = ['id', 'name', 'name_en', 'url', 'rating', 'hide', 'page_code'];

    public function getChildren($header=false, $footer=false)
    {
        $query = self::query();

        if ($header || $footer){
            $query->select(Pages::$headerFooterFields);

            if ($header) $query->where('header_hide', 0);
            if ($footer) $query->where('footer_hide', 0);
        }
       
        return $query->where('parent_id', $this->id)
            ->orderBy('rating', 'desc')
            ->orderBy('id' , 'asc')
            ->get();
    }

    public function setChildren($header, $footer)
    {
        $this->children = $this->getChildren($header, $footer);
    }

    public static function getList($header=false, $footer=false, $children=false)
    {
        $query = self::query();

        if ($header || $footer){
            $query->where('parent_id', 0)->select(Pages::$headerFooterFields);

            if ($header) $query->where('header_hide', 0);
            if ($footer) $query->where('footer_hide', 0);
        }

        $items = $query->where('hide', 0)
            ->orderBy('rating', 'desc')
            ->orderBy('id', 'asc')
            ->get();
        
        return $children ? $items->each(fn($a) => $a->setChildren($header, $footer)) : $items;
    }


    public static function getUrlByCode($page_code)
    {
        return self::where('page_code', $page_code)->select('url')->first()->url;
    }

    public function files()
    {
        return $this->hasMany(Files::class, 'item_id')->where('item_type', 'pages');
    }

    public function getFilesLinks()
    {
        $result = [];

        if (!$this->files->isEmpty())
            foreach ($this->files as $file){
                $name_array = explode('_', $file->name);
                $result[$name_array[0]][] = [
                    'name' => sizeof($name_array) == 1 ? __('Скачать') : $name_array[1],
                    'path' => $file->path 
                ];
            }
       
        return collect($result);
    }


}
