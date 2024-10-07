<?php

namespace App\Http\Controllers\Admin\Pa;

use App\Helpers\Admin\Helper;
use App\Helpers\FileUpload;
use App\Http\Controllers\Controller;
use App\Models\Pa\Acount;
use App\Models\Pa\AcountType;
use App\Models\Pa\PersonalDocument;
use App\Models\Pa\PersonalWork;
use App\Models\User\AdminEventLogs;
use Illuminate\Http\Request;
use PhpParser\Comment\Doc;

class PersonalAcountController extends Controller
{
    public $PATH = 'pa';
    public $TITLE = ['Пользователи', 'пользователя'];

    public function index(Request $request)
    {
        $path = $this->PATH;
        $title = $this->TITLE;

        $objects = Acount::query()->orderBy('id', 'desc');

        $select = collect();

        foreach (AcountType::query()->orderBy("type")->get() as $acountType) {
            $select->push((object)[
                "id" => $acountType->id,
                "name" => $acountType->type,
            ]);
        }

        if ($request->select)
            $objects = Acount::query()
                ->where(['acount_type_id' => $request->select]);

        if ($request->search)
            $objects = Acount::query()
                ->where("email", "like", "%{$request->search}%");

        if ($id = $request->delete) {
            $item = Acount::query()->find($id);
            $item->delete();
            AdminEventLogs::log(false, $id);
            return redirect()->back()->with('message', 'Удалено');
        }

        $objects = $objects->get();

        return view('admin.modules.' . $path . '.index', compact('objects', 'path', 'title', 'select'));
    }

    public function edit(Request $request, $id = null)
    {
        $path = $this->PATH;
        $title = $this->TITLE;

        $object = $id ? Acount::query()->findOrFail($id) : new Acount();

        if ($request->isMethod('post')) {

            $object->fill([
                'lastName' => $request->lastName,
                'firstName' => $request->firstName,
                'secondName' => $request->secondName,
                'email' => $request->email,
                'birthday' => $request->birthday,
                'specialty' => $request->specialty,
                'study_place' => $request->study_place,
                'snils_comment' => $request->snils_comment,
                'passport_comment' => $request->passport_comment,
                'inn_comment' => $request->inn_comment,
                'admission_year' => $request->admission_year,
            ]);

            if ($request->class > 0)
                $object->acount_type_id = $request->class;

            $object->save();

            $work = PersonalWork::query()
                ->where(['acount_id' => $object->id]);

            if ($work->count() > 0)
                $work->first()
                    ->fill([
                        'topic' => $request->topic,
                        'scientific_head' => $request->scientific_head,
                        'post' => $request->post,
                        'scientific_degree' => $request->scientific_degree,
                    ])
                    ->save();
            else PersonalWork::create([
                'acount_id' => $object->id,
                'topic' => $request->topic,
                'scientific_head' => $request->scientific_head,
                'post' => $request->post,
                'scientific_degree' => $request->scientific_degree,
            ]);


            if ($request->file("snils"))
                FileUpload::uploadFile("snils", Acount::class, 'snils', $object->id, '/pa/');

            if ($request->file("passport"))
                FileUpload::uploadFile("passport", Acount::class, 'passport', $object->id, '/pa/');

            if ($request->file("inn"))
                FileUpload::uploadFile("inn", Acount::class, 'inn', $object->id, '/pa/');

            AdminEventLogs::log($object, $id);
            return redirect()->route('admin.' . $this->PATH . '.edit', ['id' => $object->id])->with('message', 'Сохранено');
        }

        $select = collect();

        foreach (AcountType::query()->orderBy("type")->get() as $acountType) {
            $select->push((object)[
                "id" => $acountType->id,
                "name" => $acountType->type,
            ]);
        }


        return view('admin.modules.' . $this->PATH . '.edit', compact('object',  'path', 'title', 'select'));
    }
}
