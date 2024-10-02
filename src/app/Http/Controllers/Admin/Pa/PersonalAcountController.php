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
            ]);

            $object->save();

            foreach ($request->input() as $key => $value) {
                $matches = [];
                preg_match("/(post)-(\d{4})|(scientific_degree)-(\d{4})|(topic)-(\d{4})|(scientific_head)-(\d{4})/", $key, $matches);
                $collection = collect();

                array_filter($matches, function ($value) use ($collection) {
                    if (!is_null($value) && $value != "") $collection->push($value);
                });

                if ($collection->count() > 0) {
                    $work = PersonalWork::query()->where(['year' => $collection->get(2), 'acount_id' => $request->user('pa')->id])->count() > 0
                        ? PersonalWork::query()->where(['year' => $collection->get(2), 'acount_id' => $request->user('pa')->id])->first()
                        : new PersonalWork();

                    $work->fill(["{$collection->get(1)}" => "{$value}"])->save();
                }
            }

            foreach ($request->file() as $key => $value) {
                $matches = [];
                preg_match("/(workReport)-(\d{4})-(\d{1,})|(individualPlan)-(\d{4})-(\d{1,})|(yearPlan)-(\d{4})-(\d{1,})|(review)-(\d{4})-(\d{1,})|(extract)-(\d{4})-(\d{1,})|(protocol)-(\d{4})-(\d{1,})/", $key, $matches);
                $collection = collect();

                array_filter($matches, function ($value) use ($collection) {
                    if (!is_null($value) && $value != "") $collection->push($value);
                });

                if ($collection->count() > 0) {
                    $document = PersonalDocument::query()->where([
                        'year' => $collection->get(2),
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 1,
                        'personal_document_type_id' => $collection->get(3),
                    ])->count() > 0
                        ? PersonalDocument::query()->where([
                            'year' => $collection->get(2),
                            'acount_id' => $request->user('pa')->id,
                            'personal_page_id' => 1,
                            'personal_document_type_id' => $collection->get(3),
                        ])->first()
                        : (new PersonalDocument())->create([
                            'year' => $collection->get(2),
                            'acount_id' => $request->user('pa')->id,
                            'personal_page_id' => 1,
                            'personal_document_type_id' => $collection->get(3),
                        ]);

                    FileUpload::uploadFile($key, PersonalDocument::class, 'path', $document->id, '/pa/');
                }
            }

            // FileUpload::uploadFile('path', Publications::class, 'path', $object->id, '/files/publications');

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
