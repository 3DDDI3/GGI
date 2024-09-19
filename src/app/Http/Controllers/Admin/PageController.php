<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileUpload;
use App\Http\Controllers\Controller;
use App\Models\Pages\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public $PATH = 'page';
    public $TITLE = ['Страницы', 'страницы'];
    public $MODEL = Pages::class;

    public function index(Request $request)
    {
        $PATH = $this->PATH;
        $TITLE = $this->TITLE;

        $objects = $this->MODEL::orderBy('id' , 'desc' );

        if($request->search){
            $objects = $objects->where('name', 'LIKE' , '%'.str_replace(' ' , '%' , $request->search).'%');
        }

        if ($id = $request->delete){
            $item = $this->MODEL::find($id);
            if ($item->image)
                Storage::delete($item->image);
            $item->delete();
            \App\Models\User\AdminEventLogs::log(false, $id);
            return redirect()->back()->with('message' , 'Удалено');
        }

        $objects = $objects->get();


        return view('admin.modules.'.$PATH.'.index' , compact('objects', 'PATH', 'TITLE'));
    }

    public function edit(Request $request , $id = null)
    {
        $PATH = $this->PATH;
        $TITLE = $this->TITLE;

        $object = $id ? $this->MODEL::find($id) : new $this->MODEL();

        if ($request->isMethod('post')){
            $object->fill($request->except(['_token' , 'url']))->save();
            $object->url = $request->url ?? Str::slug($request->name);
            $object->header_hide = empty($request->header_hide) ? 1 : 0;
            $object->footer_hide = empty($request->footer_hide) ? 1 : 0;

            $object->parent_id = $request->parent_id ?? 0;

            $object->save();
            FileUpload::uploadImage('image' , Pages::class , 'image' , $object->id , 1920 , 1280 , '/images/pages/banners' , false , $request);

            if ($object->file)
                FileUpload::uploadFile('file', Pages::class, 'file', $object->id , '/files/pages');

            if ($request->files){
                FileUpload::uploadFiles(
                    $request,
                    'files_doc',
                    '/files/pages',
                    $object->id,
                    'pages'
                );
            }

            \App\Models\User\AdminEventLogs::log($object, $id);

            return redirect()->route('admin.'.$PATH.'.edit' , ['id' => $object->id])->with('message' , 'Сохранено');
        }

        
        return view('admin.modules.'.$PATH.'.edit' , compact('object', 'PATH', 'TITLE'));
    }

}
