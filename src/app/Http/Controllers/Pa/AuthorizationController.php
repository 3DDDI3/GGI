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
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

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
            'acount_type_id' => 2,
            'birthday' => date('Y-m-d H:i:s', strtotime($request->birthday)),
        ])->save();

        return response()->json(['message' => 'Вы успешно зарегистрировались'], 200);
    }

    public function login(Request $request)
    {
        if (!Auth::guard('pa')->attempt(['email' => $request->email, 'password' => $request->password]))
            return response()->json(['message' => "Неверный логин или пароль"], 401);

        $user = Acount::where(request()->only('name'))->first();

        $token = $user->createToken('App')->plainTextToken;

        return response([], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
