<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Admin\Helper;
use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Services;
use Illuminate\Http\Request;
use App\Helpers\FileUpload;


class ServicesController extends Controller
{
    public $PATH = 'services';
    public $TYPE = 'services';
    public $TITLE = ['Услуги', 'услуги'];
    public $MODEL = Services::class;

    public function index(Request $request)
    {
        $path = $this->PATH;
        $title = $this->TITLE;

        $objects = Content::where('type', $this->TYPE)->orderBy('id' , 'desc' );

        if($request->search) $objects = Helper::search($objects, $request->search, ['name']);

        if ($id = $request->delete){
            $item = Content::where('type', $this->TYPE)->where('id', $id)->first();

            \App\Models\User\AdminEventLogs::log(false, $item->{$item->type}->id);
            
            $item->{$item->type}->delete();
            $item->delete();
            
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
            $object->save();
            $object_item->fill($request->except(['_token']));
            $object->header_hide = empty($request->header_hide) ? 1 : 0;
            $object->footer_hide = empty($request->footer_hide) ? 1 : 0;
            $object_item->save();

            \App\Models\User\AdminEventLogs::log($object, $id);
            return redirect()->route('admin.'.$this->PATH.'.edit' , ['id' => $object->id])->with('message' , 'Сохранено');
        }


        return view('admin.modules.'.$this->PATH.'.edit' , compact('object', 'path', 'title'));
    }

}
