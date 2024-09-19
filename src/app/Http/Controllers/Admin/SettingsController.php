<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileUpload;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User\User;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(Request $request)
    {
        $object = Setting::find(1);

        if ($request->isMethod('post')){
            $object->fill($request->except(['_token']))->save();

            \App\Models\User\AdminEventLogs::log($object, $object->id);
            return redirect()->back()->with('message' , 'Изменено');
        }


        return view('admin.modules.settings.index' , compact('object'));
    }
}
