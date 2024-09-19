<?php

namespace App\Models;

use App\Models\Files;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $table = 'content';

    public $fillable = [
        'hide',
        'rating',
        'arxiv',
        'name',
        'name_en',
        'text',
        'text_en',
        'image',
        'model',
        'type',
        'item_id'
    ];

    public static function defaultList($type, $callback=null)
    {
        $query = self::query()
        ->where('type', $type)
        ->where('hide', 0)
        ->orderBy('rating', 'desc')
        ->orderBy('id', 'desc');

        if ($callback)
            call_user_func($callback, $query);


        return $query->get();
    }

    public function news()
    {
        //return $this->model==News::class ? $this->belongsTo(News::class, 'item_id') : null;
        return $this->belongsTo(News::class, 'item_id');
    }

    public function services()
    {
        //return $this->model==News::class ? $this->belongsTo(News::class, 'item_id') : null;
        return $this->belongsTo(Services::class, 'item_id');
    }

    public static function getNewsList($main_page_hide=false, $take=null, $year=null)
    {
        $query = self::query()
            ->leftJoin('news', 'news.id', '=','content.item_id')
            ->select('content.*')
            ->where('content.type', 'news')
            ->where('content.hide', 0)
            ->where('content.arxiv', 0);

        if ($year) {
            $query->where('news.date', '>', strtotime('01.01.'.$year))
                ->where('news.date', '<', strtotime('01.01.'.($year+1)));
        }

        if ($main_page_hide !== false) $query->with(['news' => fn($q) => $q->where('main_page_hide', $main_page_hide)]);
        
        if ($take) $query->take($take);

        return $query  
        ->orderBy('news.date', 'desc')
        ->get()
        ->sortByDesc('content.id')
        ->sortByDesc('content.rating')
        ->sortByDesc('news.date');
    }

    public static function getNewsYearList()
    {
        $news = self::where('type', 'news')->orderBy('created_at', 'asc')->get();
        $arr = [];
        
        foreach ($news as $news_item){
            if (!in_array(date('Y', $news_item->news->date), $arr))
                $arr[] = date('Y', $news_item->news->date);   
        }

        return $arr;
    }

    public static function getServicesList()
    {
        return self::defaultList('services');
    }

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class, 'item_id');
    }

    public function portfolioDoc()
    {
        return Files::getFile('portfolio',$this->id)->first();
    }
    public static function getPortfolioList($take=null)
    {
        $query = self::query()
        ->where('type', 'portfolio')
        ->where('hide', 0);
        
        if ($take)
            $query->take($take);
        
        return $query
        ->orderBy('rating', 'desc')
        ->orderBy('id', 'desc')
        ->get();
    }

    public function courses()
    {
        return $this->belongsTo(Courses::class, 'item_id');
    }

    public function graduates($graduate)
    {
        return $graduate->hasMany(Gallery::class, 'item_id')->where('item_type', 'graduate_asp');
    }


    public static function getCoursesList()
    {
        return self::defaultList('courses');
    }

    public static function getVacanciesList()
    {
        return self::defaultList('vacancies');
    }

    public function administration()
    {
        return $this->belongsTo(Administration::class, 'item_id');
    }

    public static function getAdministrationList()
    {
        return self::defaultList('administration');
    }

    public function departments()
    {
        return $this->belongsTo(Departments::class, 'item_id');
    }

    public function getDepartmentsChildren()
    {
        return Departments::query()
            ->where('parent_id', $this->id)
            ->get()
            ->map(fn($a) => $a->content)
            ->filter(fn($a) => ($a->hide ?? 0) === 0);
          //  ->sortBy([fn($a, $b) => $a->rating <=> $b->rating])
           // ->sortBy([fn($a, $b) => $a->id <=> $b->id]);
    }

    public static function getDepartmentsList()
    {
        return self::defaultList('departments', fn($q) => $q->whereRelation('departments', 'parent_id', '=', 0));
    }

    public static function getPublications2List()
    {
        return self::defaultList('publications2');
    }

    public static function showDepartments($departments, &$html)
    {
        foreach ($departments as $department){
            if ($department && $department->{___('name')}){
                $children = $department->getDepartmentsChildren();
              
                if (!$department->departments->parent_id){
                    $html .= '<li class="arrows-list__item">
                                <div class="arrows-list__container">
                                    <a href="'.route('structure.single', ['department'=>$department->link]).'" class="page_structure__list-title">'.($department->{___('name')}).'</a>';
                    if (!$children->isEmpty())
                        $html .= '<ul class="clear-list trait-list page_structure__trait-list">';
                }
                else{
                    $html .= '<li class="trait-list__item">
                                <a href="'.route('structure.single', ['department'=>$department->link]).'" class="trait-list__item-link">'.($department->{___('name')}).'</a>';
                    if (!$children->isEmpty())
                        $html .= '<ul class="trait-list">';
                }

                // if ($department->id == 38)
                //     dd($html);
                if (!$children->isEmpty()) 
                     self::showDepartments($children, $html);

                if (!$department->departments->parent_id){
                    if (!$children->isEmpty())
                        $html .= '</ul>';

                    $html .='        
                                </div>
                            </li>';
                }
                else{
                    if (!$children->isEmpty())
                        $html .= '</ul>';
                    $html .= '</li>';
                }
            
            }
        }

        return $html;
    }

    
}


