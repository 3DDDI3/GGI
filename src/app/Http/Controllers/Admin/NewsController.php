<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Admin\Helper;
use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\News;
use Illuminate\Http\Request;
use App\Helpers\FileUpload;


class NewsController extends Controller
{
    public $PATH = 'news';
    public $TYPE = 'news';
    public $TITLE = ['Новости', 'новость'];
    public $MODEL = News::class;

    public function index(Request $request)
    {
        $path = $this->PATH;
        $title = $this->TITLE;

        $objects = Content::where('model', $this->MODEL)->orderBy('id' , 'desc' );

        if($request->search) $objects = Helper::search($objects, $request->search, ['name']);

        if ($id = $request->delete){
            $item = Content::where('type', $this->TYPE)->where('id', $id)->first();
            $item->{$item->type}->delete();
            $item->delete();
            \App\Models\User\AdminEventLogs::log(false, $id);
            return redirect()->back()->with('message' , 'Удалено');
        }

        $objects = $objects->get();

        return view('admin.modules.'.$path.'.index' , compact('objects', 'path', 'title'));
    }

    public function edit(Request $request , $id = null)
    {
        $path = $this->PATH;
        $title = $this->TITLE;
        $object = new Content();

        $content_item = Content::where('type', $this->TYPE)->where('id', $id)->first();
        $object_item = $id ? $content_item->{$this->TYPE} : new $this->MODEL;
        $object_item->save();

        if ($content_item) $object = $content_item;

        if ($request->isMethod('post')){
            if (!$id) $object = Content::create([
                'model' => $this->MODEL,
                'type' => $this->TYPE,
                'item_id' => $object_item->id ?? 0
            ]);

            $object->fill($request->except(['_token']));
            $object->hide = empty($request->hide) ? 1 : 0;
            $object->link = $request->link ?? str_slug($object->name);
            $object->arxiv = !empty($request->arxiv) ? 1 : 0;
            $object->save();
            $object_item->fill($request->except(['_token','date']));
            $object_item->main_page_hide = empty($request->main_page_hide) ? 1 : 0;
            $object_item->date = strtotime($request->date);
            
            $object_item->save();
  

            FileUpload::uploadImage('image' , Content::class , 'image' , $object->id , 1920 , 866 , '/images/news' , false , $request);

            FileUpload::uploadGallery(
                'images',
                $object->{$object->type}->id,
                'news',
                273,
                203,
                '/images/news',
                null,
                $request
            );

            \App\Models\User\AdminEventLogs::log($object, $id);
            return redirect()->route('admin.'.$this->PATH.'.edit' , ['id' => $object->id])->with('message' , 'Сохранено');
        }

 if ($content_item) $object->main_page_hide = $object_item->main_page_hide;

        return view('admin.modules.'.$this->PATH.'.edit' , compact('object', 'path', 'title'));
    }

}
