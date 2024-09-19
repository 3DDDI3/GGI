<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface Reviews
{
    public function validate(Request $request);
    public function create($object, $item_type, Request $request);
}
