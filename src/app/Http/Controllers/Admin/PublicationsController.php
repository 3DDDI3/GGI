<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Admin\Helper;
use App\Models\Publications;
use App\Helpers\FileUpload;

class PublicationsController extends Controller
{
    public $PATH = 'publications';
    public $TITLE = ['Публикации', 'публикации'];
    public $MODEL = Publications::class;

    public function index(Request $request)
    {
        $path = $this->PATH;
        $title = $this->TITLE;

        $objects = $this->MODEL::orderBy('id' , 'desc' );

        if($request->search) $objects = Helper::search($objects, $request->search, ['name']);

        if ($id = $request->delete){
            $item = $this->MODEL::find($id);
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

        $object = $id ? $this->MODEL::findOrFail($id) : new $this->MODEL();

        if ($request->isMethod('post')){
            $object->fill($request->except(['_token']))->save();
            FileUpload::uploadImage('image' , Publications::class , 'image' , $object->id , 105 , 148 , '/images/publications' , false , $request);
            FileUpload::uploadFile('path', Publications::class, 'path', $object->id , '/files/publications');

            \App\Models\User\AdminEventLogs::log($object, $id);
            return redirect()->route('admin.'.$this->PATH.'.edit' , ['id' => $object->id])->with('message' , 'Сохранено');
        }

        return view('admin.modules.'.$this->PATH.'.edit' , compact('object' ,  'path', 'title'));
    }

}
