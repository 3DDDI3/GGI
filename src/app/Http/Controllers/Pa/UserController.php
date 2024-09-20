<?php

namespace App\Http\Controllers\Pa;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pa\MainUserRequest;
use App\Http\Requests\Pa\PersonalUserRequest;
use App\Models\Pa\Acount;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function personalDataEdit(PersonalUserRequest $request)
    {
        $request->validated();

        Acount::query()
            ->find($request->user()->id)
            ->fill($request->only([
                "lastName",
                "firstName",
                "secondName",
                "email"
            ]))
            ->save();

        return response([], 200);
    }

    public function mainInfoEdit(MainUserRequest $request)
    {
        $request->validated();

        Acount::query()
            ->find($request->user()->id)
            ->fill($request->only([
                'birthday',
                'study_place',
                'specialty',
            ]))
            ->save();

        return response([], 200);
    }
}
