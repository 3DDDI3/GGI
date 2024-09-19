<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Admin\Helper;
use App\Helpers\FileUpload;
use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;


class GraduateController extends Controller
{
    public $PATH = 'graduate';
    public $TYPE = 'graduate';
    public $GRADUATE = 'asp';
    
    public $TITLE = ['Аспирантура', 'раздела'];
    public $MODEL = null;

    public function index(Request $request)
    {
        $path = $this->PATH;
        $title = $this->TITLE;

        $objects = Content::where('type', $this->TYPE )->orderBy('rating' , 'desc' );

        if($request->search) $objects = Helper::search($objects, $request->search, ['name']);

        if ($id = $request->delete){
            $item = Content::where('type', $this->TYPE)->where('id', $id)->first();
            if ($this->MODEL) $item->{$item->type}->delete();
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
        $item_type = $this->TYPE .'_'. $this->GRADUATE;
        $blockTypes = [1=>'Текст' ,2=>'Свернутый', 3=>'Баннер 1', 4=>'Баннер 2'];

        $object = new Content();

        $content_item = Content::where('type', $this->TYPE)->where('id', $id)->first();
        // if ($this->MODEL){
        //     $object_item = $id ? $content_item->{$this->TYPE} : new $this->MODEL;
        //     $object_item->save();
        // }

        if ($content_item) $object = $content_item;



        if ($request->isMethod('post')){
            if (!$id) $object = Content::create([
                'model' => $this->MODEL,
                'type' => $this->TYPE,
                'item_id' => $object_item->id ?? 0
            ]);
            $object->fill($request->except(['_token']));
            //$object->hide = empty($request->hide) ? 1 : 0;
            $object->link = $request->link ?? '';
            $object->model = $request->model ?? 1;
            
            $object->save();
            // if ($this->MODEL){
                // $object_item->fill($request->except(['_token']));
                // $object_item->save();
            // }
  
            
            if ($request->files){
                FileUpload::uploadGallery(
                    'graduate_images',
                    $object->id,
                    $item_type,
                    600,
                    600,
                    '/images/graduate',
                    null,
                    $request
                );
            }

            \App\Models\User\AdminEventLogs::log($object, $id);
            return redirect()->route('admin.'.$this->PATH.'.edit' , ['id' => $object->id])->with('message' , 'Сохранено');
        }



        return view('admin.modules.'.$this->PATH.'.edit' , compact('object', 'path', 'title','item_type','blockTypes'));
    }

}
