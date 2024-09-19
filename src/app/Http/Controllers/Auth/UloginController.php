<?php
namespace App\Http\Controllers;

use App\Models\User\User;
use Illuminate\Http\Request;

class UloginController extends Controller
{
    public function login(Request $request)
    {
        $get = file_get_contents("https://ulogin.ru/token.php?token={$token}&host=".$_SERVER['HTTP_HOST']);
        $new = json_decode($get, true);

        $network = $new['network'] ?? '';
        $login = $email = $new['email'] ?? '';

        if (empty($login)) return redirect()->route('main');

		$ulogin_id = $new['uid'] ?? '';
		$profile = $new['profile'] ?? '';
		$photo = $new['photo_big'] ?? '';
		$name = $new['first_name'] ?? '';
		$lastname = $new['last_name'] ?? '';
		$original_city = $new['original_city'] ?? '';

        dd($new);

        $field = '';
        switch($network) {
            case 'vkontakte': $field = 'ulogin_vk'; break;
            case 'facebook': $field = 'ulogin_fb'; break;
            case 'google': $field = 'ulogin_google'; break;
        }

	    $user = User::where('login', $login)->first();
        //авторизация через соц. сети
        if ($user) {
            if (empty($user->ulogin_photo)) $user->ulogin_photo = $photo;
            if (empty($user->name)) $user->name = $name;
            if (empty($user->lastname)) $user->lastname = $lastname;
            $result = 'auth';
        }
        //регистрация через соц. сети
        else {
            $password_text = Helpers::new_password();
            $sault = Helpers::hash();
            $password = md5($sault.$password_text);
    		$hash = Helpers::hash();
    		$hash_reg = Helpers::hash();

            $user = new User();
            $user->login = $email;
            $user->email = $email;
            $user->name = $name;
            $user->lastname = $lastname;
            $user->password = $password;
            $user->sault = $sault;
            $user->hash = $hash;
            $user->hash_reg = $hash_reg;
            $user->regdate = time();
            $user->class = 4;
            $user->ulogin_photo = $photo;
            $result = 'reg';
        }

        $user->lastvisit = time();
        $user->{$field} = $profile;
        $user->ulogin_city = $original_city;
        $user->save();

        /*

        // Create new user in DB.
        $newUser = User::create([
            'nik' => $user['nickname'],
            'name' => $user['first_name'] . ' ' . $user['last_name'],
            'avatar' => $user['photo'],
            'country' => $user['country'],
            'email' => $user['email'],
            'password' => Hash::make(str_random(8)),
            'role' => 'user',
            'status' => TRUE,
            'ip' => $request->ip()
        ]);

        // Make login user.
        Auth::loginUsingId($newUser->id, TRUE);
        */
    }
}
