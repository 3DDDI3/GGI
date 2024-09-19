<?php

namespace App\Http\Controllers\Admin;

use App\Models\SEO;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Admin\Helper;

class SEOController extends Controller
{
    public $PATH = 'seo';
    public $TITLE = ['SEO', 'SEO'];

    public function index(Request $request)
    {
        $path = $this->PATH;
        $title = $this->TITLE;

        $objects = SEO::orderBy('id' , 'desc' );

        if($request->search) $objects = Helper::search($objects, $request->search, ['url']);

        if ($id = $request->delete){
            $item = SEO::find($id);
            $item->delete();
            \App\Models\User\AdminEventLogs::log(false, $id);
            return redirect()->back()->with('message' , 'Удалено');
        }

        $objects = $objects->paginate(30)->appends(request()->query());

        return view('admin.modules.seo.index' , compact('path', 'title', 'objects'));
    }

    public function edit(Request $request , $id = null)
    {
        $path = $this->PATH;
        $title = $this->TITLE;

        $object = $id ? SEO::find($id) : new SEO();

        if ($request->isMethod('post')){
            $object->fill($request->except(['_token']))->save();
            $object->save();
            \App\Models\User\AdminEventLogs::log($object, $id);
            return redirect()->route('admin.seo.edit' , ['id' => $object->id])->with('message' , 'Сохранено');
        }

        return view('admin.modules.seo.edit' , compact('path', 'title', 'object'));
    }
}
