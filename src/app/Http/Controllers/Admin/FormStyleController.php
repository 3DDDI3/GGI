<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileUpload;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Admin\Helper;

use App\Models\Eform;
use App\Models\Files;

class FormStyleController extends Controller {
  public $PATH = 'formstyle';
  public $TITLE = ['Фирменный стиль', 'раздела'];
  public $MODEL = Eform::class;

  public function index( Request $request ) {
    $path = $this->PATH;
    $title = $this->TITLE;

    $files = Files::getFile('form_style');

    $groupIds = [];
    $objects = [];

    foreach ($files as $key => &$value) {
      if (!in_array($value->item_id, $groupIds))
        $groupIds[] = $value->item_id;
    }

    foreach ($groupIds as $key => &$value) {
      $tmp = new \stdClass();

      foreach ($files as $file) {
        if ($file->item_id == $value) {
          $tmp->path = $file->path;
          break;
        }
      }

      $tmp->id = $value;
      $tmp->name = $key + 1;
      $objects[] = $tmp;
    }



    if ($id = $request->delete) {
      $files = Files::getFile('form_style', $id);

      foreach ($files as $key => $file) {
        unlink($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "storage" . DIRECTORY_SEPARATOR . $file->path);
        $file->delete();

      }
      \App\Models\User\AdminEventLogs::log(false, $id);
      return redirect()->back()->with('message', 'Удалено');


    }


    return view('admin.modules.' . $path . '.index', compact('objects', 'path', 'title'));
  }

  public function edit( Request $request, $id = null ) {
    $path = $this->PATH;
    $title = $this->TITLE;

    $object = new \stdClass();
    $object->id = $id;

    $files = Files::getFile('form_style');

    $newId = count($files) - 1 > 0 ? $files[count($files) - 1]->item_id + 1 : 1;
    $newId = count($files) === 1 ? 2 : $newId;

    $object->id = $object->id ?? $newId;
    if ($request->isMethod('post')) {
      if ($request->files) {
        FileUpload::uploadFiles(
          $request,
          'files',
          '/files/formstyle',
          $object->id ?? $files[count($files) - 1]->item_id + 1,
          'form_style'
        );
      }
      \App\Models\User\AdminEventLogs::log($object, $id);
      return redirect()->route('admin.' . $this->PATH . '.edit', ['id' => $object->id])->with('message', 'Сохранено');
    }

    return view('admin.modules.' . $this->PATH . '.edit', compact('object', 'path', 'title'));
  }

}