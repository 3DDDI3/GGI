<?php

namespace App\Http\Controllers\Pa;

use App\Http\Controllers\Controller;
use App\Models\Pa\Acount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class PersonalAccountController extends Controller
{
    public function index(Request $request)
    {
        $acount = Acount::query()
            ->find($request->user()->id);

        return view('pa.index', ['acount' => $acount]);
    }

    public function signin()
    {
        return view('pa.auth');
    }
}
