<?php

namespace App\Http\Controllers\Pa;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pa\DissertationWorkRequest;
use App\Http\Requests\Pa\MainUserRequest;
use App\Http\Requests\Pa\PersonalUserRequest;
use App\Http\Requests\Pa\ScientificSupervisorRequest;
use App\Models\Pa\Acount;
use App\Models\Pa\PersonalWork;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function personalDataEdit(PersonalUserRequest $request)
    {
        $request->validated();

        Acount::query()
            ->find($request->user('pa')->id)
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
            ->find($request->user('pa')->id)
            ->fill($request->only([
                'birthday',
                'study_place',
                'specialty',
            ]))
            ->save();

        return response([], 200);
    }

    public function dissertationWorkEdit(DissertationWorkRequest $request)
    {
        $request->validated();

        if (!empty($request->year))
            Acount::query()
                ->where(['id' => $request->user('pa')->id])
                ->first()
                ->fill(['admission_year' => $request->year])
                ->save();



        $personalWork = PersonalWork::query()
            ->where([
                'acount_id' => $request->user('pa')->id
            ])
            ->first();

        if (!$personalWork) (new PersonalWork())
            ->create([
                'topic' => $request->topic,
                'acount_id' => $request->user('pa')->id
            ]);
        else $personalWork
            ->fill($request->only(['topic']))
            ->save();

        return response([], 200);
    }

    public function scientificSupervisorEdit(ScientificSupervisorRequest $request)
    {
        $request->validated();

        $personalWork = PersonalWork::query()
            ->where([
                'acount_id' => $request->user('pa')->id
            ])
            ->first();

        if (!$personalWork) (new PersonalWork())->create([
            'acount_id' => $request->user('pa')->id,
            'year' => $request->year,
            'scientific_head' => $request->scientific_head,
            'post' => $request->input('post'),
            'scientific_degree' => $request->scientific_degree,
        ]);
        else $personalWork
            ->fill($request->only([
                'scientific_head',
                'post',
                'scientific_degree'
            ]))
            ->save();
    }
}
