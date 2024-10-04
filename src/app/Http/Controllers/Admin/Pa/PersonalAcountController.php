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

            dd($request->input(), $request->file());

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
            ]);

            $object->save();

            if ($request->file("snils"))
                FileUpload::uploadFile("snils", Acount::class, 'snils', $object->id, '/pa/');

            if ($request->file("passport"))
                FileUpload::uploadFile("passport", Acount::class, 'passport', $object->id, '/pa/');

            if ($request->file("inn"))
                FileUpload::uploadFile("inn", Acount::class, 'inn', $object->id, '/pa/');

            if ($request->file("diploma")) {
                $document = PersonalDocument::query()
                    ->where([
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 1,
                        'personal_document_type_id' => 1,
                    ])->count() > 0 ?
                    PersonalDocument::query()
                    ->where([
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 1,
                        'personal_document_type_id' => 1,
                    ])->first()
                    : (new PersonalDocument)::create([
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 1,
                        'personal_document_type_id' => 1,
                    ]);

                FileUpload::uploadFile("diploma", PersonalDocument::class, 'path', $document->id, '/pa/');
            }

            if ($request->file("report")) {
                $document = PersonalDocument::query()
                    ->where([
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 1,
                        'personal_document_type_id' => 2,
                        'year' => null
                    ])->count() > 0 ?
                    PersonalDocument::query()
                    ->where([
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 1,
                        'personal_document_type_id' => 2,
                    ])->first()
                    : (new PersonalDocument)::create([
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 1,
                        'personal_document_type_id' => 2,
                    ]);

                FileUpload::uploadFile("report", PersonalDocument::class, 'path', $document->id, '/pa/');
            }

            if ($request->file("philosophy")) {
                $document = PersonalDocument::query()
                    ->where([
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 3,
                        'personal_document_type_id' => 4,
                        'year' => null
                    ])->count() > 0
                    ? PersonalDocument::query()
                    ->where([
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 3,
                        'personal_document_type_id' => 4,
                        'year' => null
                    ])->first()
                    : (new PersonalDocument)::create([
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 3,
                        'personal_document_type_id' => 4,
                    ]);

                FileUpload::uploadFile("philosophy", PersonalDocument::class, 'path', $document->id, '/pa/');
            }

            if ($request->file("english")) {
                $document = PersonalDocument::query()
                    ->where([
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 3,
                        'personal_document_type_id' => 5,
                        'year' => null
                    ])->count() > 0
                    ? PersonalDocument::query()
                    ->where([
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 3,
                        'personal_document_type_id' => 5,
                        'year' => null
                    ])->first()
                    : (new PersonalDocument)::create([
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 3,
                        'personal_document_type_id' => 5,
                    ]);

                FileUpload::uploadFile("english", PersonalDocument::class, 'path', $document->id, '/pa/');
            }

            if ($request->file("specialtyDoc")) {
                $document = PersonalDocument::query()
                    ->where([
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 3,
                        'personal_document_type_id' => 6,
                        'year' => null
                    ])->count() > 0
                    ? PersonalDocument::query()
                    ->where([
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 3,
                        'personal_document_type_id' => 6,
                        'year' => null
                    ])->first()
                    : (new PersonalDocument)::create([
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 3,
                        'personal_document_type_id' => 6,
                    ]);

                FileUpload::uploadFile("specialtyDoc", PersonalDocument::class, 'path', $document->id, '/pa/');
            }

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

                $matches = [];
                preg_match("/(workReportComment)-(\d{4})-(\d{1,})|(individualPlanComment)-(\d{4})-(\d{1,})|(yearPlanComment)-(\d{4})-(\d{1,})|(reviewComment)-(\d{4})-(\d{1,})|(extractComment)-(\d{4})-(\d{1,})|(protocolComment)-(\d{4})-(\d{1,})/", $key, $matches);
                $collection = collect();

                array_filter($matches, function ($value) use ($collection) {
                    if (!is_null($value) && $value != "") $collection->push($value);
                });

                if ($collection->count() > 0) {
                    $document = PersonalDocument::query()
                        ->where([
                            'year' => $collection->get(2),
                            'acount_id' => $request->user('pa')->id,
                            'personal_page_id' => 1,
                            'personal_document_type_id' => $collection->get(3),
                        ])->count() > 0
                        ? PersonalDocument::query()
                        ->where([
                            'year' => $collection->get(2),
                            'acount_id' => $request->user('pa')->id,
                            'personal_page_id' => 1,
                            'personal_document_type_id' => $collection->get(3),
                        ])->first()
                        : null;

                    // dd($collection, $value, $document);

                    if (!empty($document))
                        $document->fill(['comment' => $value])
                            ->save();
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
                            'personal_document_type_id' => $collection->get(3)
                        ])->first()
                        : (new PersonalDocument())->create([
                            'year' => $collection->get(2),
                            'acount_id' => $request->user('pa')->id,
                            'personal_page_id' => 1,
                            'personal_document_type_id' => $collection->get(3),
                        ]);

                    $document->fill(['comment' => $request->input("{$collection->get(1)}Comment-{$collection->get(2)}-{$collection->get(3)}")])
                        ->save();

                    FileUpload::uploadFile($key, PersonalDocument::class, 'path', $document->id, '/pa/');
                }
            }

            if ($request->file("materials")) {
                $document = PersonalDocument::query()->where([
                    'year' => null,
                    'acount_id' => $request->user('pa')->id,
                    'personal_page_id' => 2,
                    'personal_document_type_id' => 7,
                ])->count() > 0
                    ? PersonalDocument::query()->where([
                        'year' => null,
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 2,
                        'personal_document_type_id' => 7
                    ])->first()
                    : (new PersonalDocument())->create([
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 2,
                        'personal_document_type_id' => 7,
                    ]);

                FileUpload::uploadFile("materials", PersonalDocument::class, 'path', $document->id, '/pa/');
            }

            if ($request->file("thesis")) {
                $document = PersonalDocument::query()->where([
                    'year' => null,
                    'acount_id' => $request->user('pa')->id,
                    'personal_page_id' => 2,
                    'personal_document_type_id' => 8,
                ])->count() > 0
                    ? PersonalDocument::query()->where([
                        'year' => null,
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 2,
                        'personal_document_type_id' => 8
                    ])->first()
                    : (new PersonalDocument())->create([
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 2,
                        'personal_document_type_id' => 8,
                    ]);

                FileUpload::uploadFile("thesis", PersonalDocument::class, 'path', $document->id, '/pa/');
            }

            if ($request->file("article")) {
                $document = PersonalDocument::query()->where([
                    'year' => null,
                    'acount_id' => $request->user('pa')->id,
                    'personal_page_id' => 2,
                    'personal_document_type_id' => 9,
                ])->count() > 0
                    ? PersonalDocument::query()->where([
                        'year' => null,
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 2,
                        'personal_document_type_id' => 9
                    ])->first()
                    : (new PersonalDocument())->create([
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 2,
                        'personal_document_type_id' => 9,
                    ]);

                FileUpload::uploadFile("article", PersonalDocument::class, 'path', $document->id, '/pa/');
            }

            if ($request->file("rid")) {
                $document = PersonalDocument::query()->where([
                    'year' => null,
                    'acount_id' => $request->user('pa')->id,
                    'personal_page_id' => 2,
                    'personal_document_type_id' => 10,
                ])->count() > 0
                    ? PersonalDocument::query()->where([
                        'year' => null,
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 2,
                        'personal_document_type_id' => 10
                    ])->first()
                    : (new PersonalDocument())->create([
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 2,
                        'personal_document_type_id' => 10,
                    ]);

                FileUpload::uploadFile("rid", PersonalDocument::class, 'path', $document->id, '/pa/');
            }

            if ($request->file("other")) {
                $document = PersonalDocument::query()->where([
                    'year' => null,
                    'acount_id' => $request->user('pa')->id,
                    'personal_page_id' => 2,
                    'personal_document_type_id' => 3,
                ])->count() > 0
                    ? PersonalDocument::query()->where([
                        'year' => null,
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 2,
                        'personal_document_type_id' => 3
                    ])->first()
                    : (new PersonalDocument())->create([
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 2,
                        'personal_document_type_id' => 3,
                    ]);

                FileUpload::uploadFile("other", PersonalDocument::class, 'path', $document->id, '/pa/');
            }

            if ($request->file("aspirantReport")) {
                $document = PersonalDocument::query()->where([
                    'year' => null,
                    'acount_id' => $request->user('pa')->id,
                    'personal_page_id' => 2,
                    'personal_document_type_id' => 11,
                ])->count() > 0
                    ? PersonalDocument::query()->where([
                        'year' => null,
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 2,
                        'personal_document_type_id' => 11
                    ])->first()
                    : (new PersonalDocument())->create([
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 2,
                        'personal_document_type_id' => 11,
                    ]);

                FileUpload::uploadFile("aspirantReport", PersonalDocument::class, 'path', $document->id, '/pa/');
            }

            if ($request->philosophy_comment) {
                $document = PersonalDocument::query()
                    ->where([
                        'year' => null,
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 3,
                        'personal_document_type_id' => 4
                    ])
                    ->first();

                if ($document) $document->fill(['comment' => $request->philosophy_comment])
                    ->save();
            }

            if ($request->english_comment) {
                $document = PersonalDocument::query()
                    ->where([
                        'year' => null,
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 3,
                        'personal_document_type_id' => 5
                    ])
                    ->first();

                if ($document) $document->fill(['comment' => $request->english_comment])
                    ->save();
            }

            if ($request->specialtyDoc_comment) {
                $document =  PersonalDocument::query()
                    ->where([
                        'year' => null,
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 3,
                        'personal_document_type_id' => 6
                    ])
                    ->first();

                if ($document) $document->fill(['comment' => $request->specialtyDoc_comment])
                    ->save();
            }

            if ($request->rid_comment) {
                $document = PersonalDocument::query()
                    ->where([
                        'year' => null,
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 2,
                        'personal_document_type_id' => 10
                    ])
                    ->first();

                if ($document) $document->fill(['comment' => $request->rid_comment])
                    ->save();
            }

            if ($request->materials_comment) {
                $document = PersonalDocument::query()
                    ->where([
                        'year' => null,
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 2,
                        'personal_document_type_id' => 7
                    ])
                    ->first();

                dd($document);

                if ($document) $document->fill(['comment' => $request->materials_comment])
                    ->save();
            }

            if ($request->thesis_comment) {
                $document = PersonalDocument::query()
                    ->where([
                        'year' => null,
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 2,
                        'personal_document_type_id' => 8
                    ])
                    ->first();

                if ($document) $document->fill(['comment' => $request->thesis_comment])
                    ->save();
            }

            if ($request->article_comment) {
                $document = PersonalDocument::query()
                    ->where([
                        'year' => null,
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 2,
                        'personal_document_type_id' => 9
                    ])
                    ->first();

                if ($document) $document->fill(['comment' => $request->article_comment])
                    ->save();
            }

            if ($request->other_comment) {
                $document = PersonalDocument::query()
                    ->where([
                        'year' => null,
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 2,
                        'personal_document_type_id' => 3
                    ])
                    ->first();

                if ($document) $document->fill(['comment' => $request->other_comment])
                    ->save();
            }

            if ($request->aspirantReport_comment) {
                $document = PersonalDocument::query()
                    ->where([
                        'year' => null,
                        'acount_id' => $request->user('pa')->id,
                        'personal_page_id' => 2,
                        'personal_document_type_id' => 11
                    ])
                    ->first();

                if ($document) $document->fill(['comment' => $request->aspirantReport_comment])
                    ->save();
            }


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
