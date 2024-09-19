<?php

namespace App\Models\Page;

use App\Models\Reviews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'page';

    public $fillable = [
        'title' ,
        'text',
        'url',
        'section_id',
        'footer_show',
        'header_show',
        'rating'
    ];

    public static function list(){
        $self = self::select('id', 'title', 'url')
            ->where('hide', 0)
            ->get();
        $list = array();
        foreach ($self as $item) {
            $item_id = $item->id ?? 0;
            $list[$item_id] = $item;
        }
        return $list;
    }

    public function reviews()
    {
        return $this->hasMany(Reviews::class, 'item_id')->where('item_type', 'pages');
    }

    public function getReviewsList($skip = null)
    {
        return Reviews::getList($this->reviews(), $skip);
    }

    public function getReviewsCount()
    {
        return $this
            ->reviews()
            ->where('hide' , 0)
            ->where('review_id', 0)
            ->get()
            ->count();
    }

    public static function getUrlByCode($page_code)
    {
        return self::where('page_code', $page_code)->select('url')->first()->url;
    }


}
