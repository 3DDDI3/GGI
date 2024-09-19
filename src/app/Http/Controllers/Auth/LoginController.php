<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Admin\Helper;
use App\Helpers\Mail;
use App\Http\Controllers\Controller;
use App\Models\Discounts\Bonuses\BonusesHistory;
use App\Models\User\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use App\Models\Setting;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'admin/settings';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //Принять правила Cookie
    public function notice_cookie(Request $request) {

        Cookie::queue('notice_cookie', 1, 43200); //на 30 дней

        return response()->json(['Cookie set successfully.']);
    }

    //Войти или создать
    public function login_code(Request $request) {
        $method = $request->input('method') ?? '';

        switch ($method) {
            case 'code_check': return self::code_check($request); break;
            case 'code_phone': return self::code_save($request, 'phone'); break;
            case 'code_email': return self::code_save($request, 'email'); break;
        }
        return;
    }

    //Код по номеру телефона
    private static function code_save($request, $type = 'phone') {

        $phone = $post_phone = $request->input('phone') ?? '';
        $email = $post_email = $request->input('email') ?? '';
        if (empty($phone) && empty($email)) return;

        $phone = trim($phone);
        $email = trim($email);

        $diff = 0;

        if (!empty($post_phone)) {
            $user = User::where('phone', $phone)->first();
            $email = 'email'.Helper::hash();
        }
        else {
            $user = User::where('email', $email)->first();
            $phone = null;
        }
        if (!$user) {
            $user = new User();
            $user->name = '';
            $user->phone = $phone;
            $user->email = $email;
            $user->is_admin = 0;
            $user->password = Hash::make(\Str::random(10)); //генерим случайный пароль
            $user->save();

            BonusesHistory::execute('accrual', 'registration', Setting::find(1)->registration_bonuses, $user->id);

            $id = $user->id ?? 0;

            if (!empty($post_phone)) $user->email = 'email'.$id;
        }
        else {
            //проверка даты последнего запроса кода
            $code_time = $user->code_time ?? '';
            if (!empty($code_time)) {
                $time1 = strtotime($code_time);
                $time2 = now()->timestamp;
                $diff = (int)$time2 - $time1;

                if ($diff < 60 && $diff > 1) { //через 60 секунд можно генерить новый код
                    $start = sprintf('%02d', 60 - $diff);
                    return $start;
                }
            }
        }

        $code = sprintf('%04d', rand(0, 9999)); //генерим случайный четырехзначный код

        if (!empty($post_phone)) {
            $code = '4207'; //пока для тестов
        }

        $user->code = $code;
        $user->code_time = now();
        $user->save();

        //На телефон
        if (!empty($post_phone)) {
            //Звонок последними 4-мя цифрами кода
            //https://sms.ru/api/code_call


            //$sender = 'B-Media';
            //$myphone = '+79633043207';
            //$sendSms = SigmaSms::send('sms', $myphone, $sender, '4207');
            //var_dump($sendSms);
        }

        //На почту
        if (!empty($post_email)) {
            $subject = 'Ваш код подтверждения: '.$code;
            $message = view('mail.code_email', [
                'code' => $code
            ]);
            Mail::send($email, $subject, $message);
        }

        $send = 'send';

        return $send;
    }

    //Проверка кода
    private static function code_check($request) {

        $phone = $request->input('phone') ?? '';
        $email = $request->input('email') ?? '';
        $code = $request->input('code') ?? '';

        if (empty($phone) && empty($email)) return;
        if ($code == '') return;

        if (!empty($phone)) $user = User::where('phone', $phone)->first();
        if (!empty($email)) $user = User::where('email', $email)->first();

        if (!$user) return 'Пользователь с таким телефоном не найден';

        if (empty($user->code) || $code <> $user->code) return 'Неверный код попробуйте еще раз';

        if (!empty($phone) && empty($user->phone_verified_at)) $user->phone_verified_at = now();
        if (!empty($email) && empty($user->email_verified_at)) $user->email_verified_at = now();

        $user->code = null;
        $user->code_time = null;
        $user->save();
        $id = $user->id ?? 0;

        Auth::loginUsingId($id); //авторизуем по Id

        return 'login';
    }

    //Авторизация через соц.сети
    public function ulogin(Request $request) {

        $token = $request->token ?? '';
        if (empty($token)) return;

        $get = file_get_contents("https://ulogin.ru/token.php?token={$token}&host=".$_SERVER['HTTP_HOST']);
        $new = json_decode($get, true);

        $network = $new['network'] ?? '';
        $login = $email = $new['email'] ?? '';

        if (empty($login)) return redirect()->route('main');

		$ulogin_id = $new['uid'] ?? '';
		$profile = $new['profile'] ?? '';
		$photo = $new['photo_big'] ?? '';
		if (empty($photo)) $photo = $new['photo'] ?? '';
		$name = $new['first_name'] ?? '';
		$lastname = $new['last_name'] ?? '';
		$city = $new['city'] ?? '';
		$country = $new['country'] ?? '';
		$verified_email = $new['verified_email'] ?? '';
		$birthday = $new['bdate'] ?? '';
		$gender = $new['sex'] ?? ''; //2 - мужской пол

        $field = '';
        switch($network) {
            case 'vkontakte': $field = 'ulogin_vkontakte'; break;
            case 'google': $field = 'ulogin_google'; break;
            case 'yandex': $field = 'ulogin_yandex'; break;
        }

        $user = User::where('email', $email)->first();
        if (!$user) {
            $user = new User();
            $user->email = $email;
            $user->is_admin = 0;
            $user->password = Hash::make(\Str::random(10)); //генерим случайный пароль

            BonusesHistory::execute('accrual', 'registration', Setting::find(1)->registration_bonuses, $user->id);
        }

        if (empty($user->name)) $user->name = $name;
        if (empty($user->lastname)) $user->lastname = $lastname;

        if (empty($user->ulogin_photo)) $user->ulogin_photo = $photo;

        if (empty($user->city)) $user->city = $city;
        if (empty($user->country)) $user->country = $country;

        if (empty($user->birthday) && !empty($birthday)) {
            $user->birthday = date('Y-m-d H:i:s', strtotime($birthday));
        }
        if (empty($user->gender) && !empty($gender)) {
            $user->gender = (int)$gender;
        }
        if (empty($user->email_verified_at) && !empty($verified_email)) {
            $user->email_verified_at = now();
        }
        $user->{$field} = $profile;
        $user->save();

        $id = $user->id ?? 0;

        Auth::loginUsingId($id); //авторизуем по Id

        return redirect()->route('profile');
    }
}
