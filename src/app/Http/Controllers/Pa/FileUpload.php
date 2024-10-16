<?php

namespace App\Http\Controllers\Pa;

use App\Http\Controllers\Controller;
use App\Models\Pa\Acount;
use App\Models\Pa\PersonalDocument;
use App\Models\Pa\PersonalDocumentType;
use App\Models\Pa\PersonalPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUpload extends Controller
{
    public function upload(Request $request)
    {
        $user = empty($request->user('pa')) ? $request->input('user') : $request->user('pa')->id;

        if (!empty($request->comment)) {
            PersonalDocument::query()
                ->where([
                    'acount_id' => $user,
                    'personal_document_type_id' => PersonalDocumentType::query()
                        ->where(['type' => $request->document])
                        ->first()->id,
                    'personal_page_id' => PersonalPage::query()
                        ->where(['page' => $request->page])
                        ->first()->id
                ])
                ->first()
                ->fill(['comment' => $request->comment])
                ->save();

            return response()->json(['message' => 'Комментарий обновлен'], 200);
        }

        foreach ($request->file() as $name => $file) {
            $path = $file->store('pa');

            if (empty($request->page) && empty($request->document)) {
                $documents = Acount::query()
                    ->find($user)
                    ->fill([$name => $path])
                    ->save();

                return response()->json(['image' => $path], 200);
            }

            $page = PersonalPage::query()
                ->where(['page' => $request->page])
                ->first();

            $documentType = PersonalDocumentType::query()
                ->where(['type' => $request->document])
                ->first();

            (new PersonalDocument())->create([
                'acount_id' => $user,
                'personal_document_type_id' => $documentType->id,
                'personal_page_id' => $page->id,
                'control_name' => $request->control,
                'path' => $path,
                'year' => $request->year,
            ]);
        }

        $documents = PersonalDocument::query()
            ->where([
                'acount_id' => $request->user('pa')->id,
                'personal_document_type_id' => $documentType->id,
                'personal_page_id' => $page->id,
                'control_name' => $request->control,
            ])->get();

        return response(['documents' => $documents], 200);
    }

    public function delete(Request $request)
    {
        $user = empty($request->user('pa')) ? $request->input('user') : $request->user('pa')->id;

        $acount = Acount::query()
            ->find($user);

        if (!empty($request->name)) {
            $field = $request->name;
            $field_comment = "{$request->name}_comment";
            $acount->$field = null;
            $acount->$field_comment = null;

            $acount->save();

            Storage::delete($request->input('path'));

            return response()->json(['message' => 'Файл успешно удален'], 200);
        }

        $personalDocument = PersonalDocument::query()
            ->where([
                'acount_id' => $acount->id,
                'path' => $request->input('path')
            ])
            ->first();

        if (!$personalDocument)
            return response()->json(['message' => 'Что-то пошло не так'], 400);

        Storage::delete($request->input('path'));

        $personalDocument->delete();

        return response()->json(['message' => 'Файл успешно удален'], 200);
    }
}
