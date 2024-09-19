<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Admin\Helper;
use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Departments;
use App\Models\Staff;
use App\Models\StaffDef;
use Illuminate\Http\Request;


class DepartmentsController extends Controller
{
    public $PATH = 'departments';
    public $TYPE = 'departments';
    public $TITLE = ['Отделы', 'отдела'];
    public $MODEL = Departments::class;

    public function index(Request $request)
    {
        $path = $this->PATH;
        $title = $this->TITLE;

        $objects = Content::where('type', $this->TYPE )->orderBy('id' , 'desc' );

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
        $object = new Content();

        $content_item = Content::where('type', $this->TYPE)->where('id', $id)->first();
        $staff = Staff::where('hide', 0)->get();
        $staff_item = StaffDef::where('id_dep', $content_item->item_id)->get();
        if (!empty($staff_item)) {
            foreach ($staff as $item) {
                foreach ($staff_item as $value) {
                    if ($value->id_staff == $item->id) {
                        $item->check = true;
                        break;
                    }else{
                        $item->check = false;
                    }
                }
            }
        }
        if ($this->MODEL){
            $object_item = $content_item ? $content_item->{$this->TYPE} : new $this->MODEL;
            $object_item->save();
        }

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
            if ($this->MODEL){
                $object_item->fill($request->except(['_token']));
                $object_item->save();
            }

            // $staff = Staff::where('hide', 0)->get();
            $allStaff = StaffDef::get();
            $isserStaff = StaffDef::where('id_dep', $content_item->item_id)->get();

            if (!empty($isserStaff)) {
                foreach ($allStaff as $value) {
                    if($value->id_dep == $content_item->item_id){
                        var_dump($value->id.'yes');
                        $value->delete();
                    }
                }
            }

            foreach ($staff as $item) {
                $inputName = 'idStaff'.$item->id;
                if(!empty($request->$inputName)){
                    var_dump($item->id);
                    $newStaffDep = new StaffDef();
                    $newStaffDep->id_staff = $item->id;
                    $newStaffDep->id_dep = $content_item->item_id;
                    $newStaffDep->save();

                }
            }
  
            \App\Models\User\AdminEventLogs::log($object, $id);
            return redirect()->route('admin.'.$this->PATH.'.edit' , ['id' => $object->id])->with('message' , 'Сохранено');
        }


        return view('admin.modules.'.$this->PATH.'.edit' , compact('object', 'staff', 'path', 'title'));
    }

}
