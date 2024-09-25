<?php

namespace App\Http\Controllers\Pa;

use App\Http\Controllers\Controller;
use App\Models\Pa\Acount;
use App\Models\Pa\PersonalDocument;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class PersonalAccountController extends Controller
{
    public function index(Request $request)
    {
        $acount = Acount::query()
            ->find($request->user()->id);

        $documents = PersonalDocument::query()
            ->where([
                'hide' => 0,
                'acount_id' => $request->user()->id
            ])
            ->get();

        return view('pa.index', ['acount' => $acount, 'documents' => $documents]);
    }

    public function signin()
    {
        return view('pa.auth');
    }
}
