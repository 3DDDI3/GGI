<?php

namespace App\Http\Controllers\Pa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class PersonalAccountController extends Controller
{
    public function index()
    {
        return view('pa.index');
    }

    public function signin()
    {
        return view('pa.auth');
    }
}
