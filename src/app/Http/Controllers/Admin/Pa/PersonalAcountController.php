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
                'birthday' => date('Y-m-d H:i:s', strtotime($request->birthday)),
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



            foreach (
                PersonalDocument::query()->where([
                    'acount_id' => $object->id,
                    'personal_document_type_id' => 1,
                    'personal_page_id' => 1
                ])->get() as $doc
            ) {
                $doc->fill(['comment' => $request->diplom1_comment])->save();
            }


            foreach (
                PersonalDocument::query()->where([
                    'acount_id' => $object->id,
                    'personal_document_type_id' => 2,
                    'personal_page_id' => 1
                ])->get() as $doc
            ) {
                $doc->fill(['comment' => $request->report1_comment])->save();
            }

            foreach (
                PersonalDocument::query()->where([
                    'acount_id' => $object->id,
                    'personal_document_type_id' => 12,
                    'personal_page_id' => 1
                ])->get() as $doc
            ) {
                $doc->fill(['comment' => $request->individual_plan_comment])->save();
            }

            foreach (
                PersonalDocument::query()->where([
                    'acount_id' => $object->id,
                    'personal_document_type_id' => 15,
                    'personal_page_id' => 1
                ])->get() as $doc
            ) {
                $doc->fill(['comment' => $request->vipiska_comment])->save();
            }


            foreach (
                PersonalDocument::query()->where([
                    'acount_id' => $object->id,
                    'personal_document_type_id' => 16,
                    'personal_page_id' => 1
                ])->get() as $doc
            ) {
                $doc->fill(['comment' => $request->protokol_comment])->save();
            }

            foreach (
                PersonalDocument::query()->where([
                    'acount_id' => $object->id,
                    'personal_document_type_id' => 14,
                    'personal_page_id' => 1
                ])->get() as $doc
            ) {
                $doc->fill(['comment' => $request->review_comment])->save();
            }


            foreach (
                PersonalDocument::query()->where([
                    'acount_id' => $object->id,
                    'personal_document_type_id' => 13,
                    'personal_page_id' => 1
                ])->get() as $doc
            ) {
                $doc->fill(['comment' => $request->scientific_plan_comment])->save();
            }


            foreach (
                PersonalDocument::query()->where([
                    'acount_id' => $object->id,
                    'personal_document_type_id' => 7,
                    'personal_page_id' => 2
                ])->get() as $doc
            ) {
                $doc->fill(['comment' => $request->materials_comment])->save();
            }

            foreach (
                PersonalDocument::query()->where([
                    'acount_id' => $object->id,
                    'personal_document_type_id' => 9,
                    'personal_page_id' => 2
                ])->get() as $doc
            ) {
                $doc->fill(['comment' => $request->article_comment])->save();
            }


            foreach (
                PersonalDocument::query()->where([
                    'acount_id' => $object->id,
                    'personal_document_type_id' => 8,
                    'personal_page_id' => 2
                ])->get() as $doc
            ) {
                $doc->fill(['comment' => $request->thesis_comment])->save();
            }


            foreach (
                PersonalDocument::query()->where([
                    'acount_id' => $object->id,
                    'personal_document_type_id' => 10,
                    'personal_page_id' => 2
                ])->get() as $doc
            ) {
                $doc->fill(['comment' => $request->rid_comment])->save();
            }


            foreach (
                PersonalDocument::query()->where([
                    'acount_id' => $object->id,
                    'personal_document_type_id' => 3,
                    'personal_page_id' => 2
                ])->get() as $doc
            ) {
                $doc->fill(['comment' => $request->other_comment])->save();
            }


            foreach (
                PersonalDocument::query()->where([
                    'acount_id' => $object->id,
                    'personal_document_type_id' => 11,
                    'personal_page_id' => 2
                ])->get() as $doc
            ) {
                $doc->fill(['comment' => $request->aspirant_report_comment])->save();
            }


            foreach (
                PersonalDocument::query()->where([
                    'acount_id' => $object->id,
                    'personal_document_type_id' => 2,
                    'personal_page_id' => 2
                ])->get() as $doc
            ) {
                $doc->fill(['comment' => $request->report_comment])->save();
            }


            foreach (
                PersonalDocument::query()->where([
                    'acount_id' => $object->id,
                    'personal_document_type_id' => 1,
                    'personal_page_id' => 2
                ])->get() as $doc
            ) {
                $doc->fill(['comment' => $request->diploma_comment])->save();
            }


            foreach (
                PersonalDocument::query()->where([
                    'acount_id' => $object->id,
                    'personal_document_type_id' => 4,
                    'personal_page_id' => 3
                ])->get() as $doc
            ) {
                $doc->fill(['comment' => $request->philosophy_comment])->save();
            }

            foreach (
                PersonalDocument::query()->where([
                    'acount_id' => $object->id,
                    'personal_document_type_id' => 5,
                    'personal_page_id' => 3
                ])->get() as $doc
            ) {
                $doc->fill(['comment' => $request->english_comment])->save();
            }

            foreach (
                PersonalDocument::query()->where([
                    'acount_id' => $object->id,
                    'personal_document_type_id' => 6,
                    'personal_page_id' => 3
                ])->get() as $doc
            ) {
                $doc->fill(['comment' => $request->english_comment])->save();
            }

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
