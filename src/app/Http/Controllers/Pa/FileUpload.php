<?php

namespace App\Http\Controllers\Pa;

use App\Http\Controllers\Controller;
use App\Models\Pa\Acount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUpload extends Controller
{
    public function upload(Request $request)
    {
        foreach ($request->file() as $name => $file) {
            $path = $file->store('pa');

            Acount::query()
                ->find($request->user()->id)
                ->fill([$name => $path])
                ->save();
        }

        return response([], 200);
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
