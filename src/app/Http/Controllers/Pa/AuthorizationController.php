<?php

namespace App\Http\Controllers\Pa;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authorization\SignRequest;
use App\Models\Pa\Acount;
use App\Models\User\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthorizationController extends Controller
{
    public function signin(SignRequest $request)
    {
        $value = $request->validated();

        (new Acount())->fill([
            'lastName' => $request->lastName,
            'firstName' => $request->firstName,
            'secondName' => $request->secondName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birthday' => $request->birthday
        ])->save();

        return response()->json(['message' => 'Вы успешно зарегистрировались'], 200);
    }

    public function login(Request $request)
    {
        $acount = Acount::query()
            ->where(['email' => $request->email])->first();

        if (! Hash::check($request->password, $acount->password))
            return response()->json(['message' => 'Неверный email и/или пароль'], 401);

        Auth::guard('web')->login($acount);

        $token = $acount->createToken('App')->plainTextToken;

        // $user = User::query()->where(['email' => $request->email])->first();

        // if (!Hash::check($request->password, $user->password))
        //     return;

        // Auth::login($user);

        // $token =  Auth::user()->createToken('App')->plainTextToken;
        // dd($token);
        return response([], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
    }

    public function check(Request $request)
    {
        dd(Auth::user());
    }
}
