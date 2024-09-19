<?php

namespace App\Http\Controllers\Admin\Users;

use App\Helpers\Admin\Helper;
use App\Http\Controllers\Controller;
use App\Models\User\AdminAccessRights;
use App\Models\User\UserСlasses;
use Illuminate\Http\Request;


class UsersClassesController extends Controller
{
    public $PATH = 'users.classes';
    public $TITLE = ['Классы пользователей', 'класса'];
    public $MODEL = UserСlasses::class;

    public function index(Request $request)
    {
        $path = $this->PATH;
        $title = $this->TITLE;

        $objects = $this->MODEL::orderBy('id' , 'desc' );

        if($request->search){
            $objects = $objects->where('name', 'LIKE' , '%'.str_replace(' ' , '%' , $request->search).'%');
        }

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

        $object = $id ? $this->MODEL::find($id) : new $this->MODEL();

        if ($request->isMethod('post')){
            $object->fill($request->except(['_token', 'rights']));
            $object->save();

            if ($request->rights){
                if ($object->rights())
                    $object->rights()->delete();
                foreach ($request->rights as $path => $rights){
                    foreach ($rights as $type => $value){
                        $right_object = new AdminAccessRights();
                        $right_object->path = $path;
                        $right_object->type = $type;
                        $right_object->user_class_id = $object->id;
                        $right_object->save();
                    }
                }
            }
            \App\Models\User\AdminEventLogs::log($object, $id);
            return redirect()->route('admin.'.$this->PATH.'.edit' , ['id' => $object->id])->with('message' , 'Сохранено');
        }

        $admin_sections = Helper::getAdminSections($object);

        return view('admin.modules.'.$this->PATH.'.edit' , compact('object' ,  'path', 'title', 'admin_sections'));
    }

}
