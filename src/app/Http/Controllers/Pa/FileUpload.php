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
        foreach ($request->file() as $name => $file) {
            $path = $file->store('pa');

            if (empty($request->page) && empty($request->document)) {
                Acount::query()
                    ->find($request->user()->id)
                    ->fill([$name => $path])
                    ->save();

                return;
            }

            $page = PersonalPage::query()
                ->where(['page' => $request->page])
                ->first();

            $documentType = PersonalDocumentType::query()
                ->where(['type' => $request->document])
                ->first();

            (new PersonalDocument())->create([
                'acount_id' => $request->user()->id,
                'personal_document_type_id' => $documentType->id,
                'personal_page_id' => $page->id,
                'path' => $path,
                'year' => $request->year,
            ]);
        }


        $documents = PersonalDocument::query()
            ->where([
                'acount_id' => $request->user()->id,
                'personal_document_type_id' => $documentType->id,
                'personal_page_id' => $page->id,
            ])->get();

        return response(['documents' => $documents], 200);
    }

    public function delete(Request $request)
    {

        $acount = Acount::query()
            ->find($request->user()->id);

        if (
            $acount->query()
            ->where([$request->input('name') => $request->input('path')])
            ->count() == 0
        )
            return response()->json(['message' => 'Что-то пошло нет так'], 400);

        Storage::delete($request->input('path'));

        $acount->fill([$request->input('name') => null])
            ->save();

        return response()->json(['message' => 'Файл успешно удален'], 200);
    }
}
