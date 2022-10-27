<?php

namespace App\Http\Controllers\OAuth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OauthController
{

    public function redirectToService($service, Request $request)
    {
        session(['ip' => $request->ip()]);
        return Socialite::driver($service)->redirect();
    }

    public function handleCallback($service)
    {
        // здесь пишем в сессию чтобы не было редиректа на страницу о необходимости подтверждения email
        // для OAuth это не нужно в отличии от обычной регистрации
        // в файле app/Http/Controllers/Auth/EmailVerificationPromptController.php проверяем значение сессии если true то
        // сразу редиректим на главную без всяких напоминаний о подтверждении email
        session(['is_oauth' => true]);
        $user = Socialite::driver($service)->user();
//        dd($user->user);
        if ($service == 'yandex') {
            $name = $user->nickname;
            $email = $user->nickname . '@yandex.ru'; // вот такая дичь
            $avatar = null;
        } elseif($service == 'google') {
            $name = $user->name;
            $email = $user->email;
            $avatar = $user->user['picture'] ?? null;
        }elseif($service == 'vkontakte'){
            $name = $user->name;
            $email = $user->email;
            $avatar = $user->user['photo_200'] ?? null;
        }elseif($service == 'odnoklassniki'){
            $name = $user->name;
            $email = $user->email;
            $avatar = $user->user['pic_1'];
        }elseif($service == 'gitgub'){
            $name = $user->name;
            $email = $user->email;
            $avatar = $user->user['avatar_url'];
        }else{
            $name = $user->name;
            $email = $user->email;
            $avatar = null;
        }
        try {
            $finduser = User::where($service . '_id', $user->id)->first();
            if ($finduser) { //уже заходил
                Auth::login($finduser);
                return redirect()->intended('dashboard');
            } else { // впервые
                $newUser = User::create([
                    'name' => $name,
                    'email' => $email,
                    'avatar' => $avatar,
                    'oauth_client' => $service,
                    $service . '_id' => $user->id, // в базе поля вида google_id yandex_id ...
                    'password' => Str::random(8),
                    'email_verified_at' => date("Y-m-d H:i:s"),
                    'ip' => session('ip'),
                ]);
                Auth::login($newUser);
                return redirect()->intended('dashboard');
            }
        } catch (Exception $e) {
            // поскольку поле email у нас unique возможны ошибки MYSQL
            $findOldLogin = User::where('email', $user->email)->first();
            if ($findOldLogin->oauth_client) { // юзер уже логинился через какой то сервис с таким же email
                return view('auth.oauth-except', [
                    'id' => $findOldLogin->id,
                    'email' => $findOldLogin->email,
                    'oauth_client' => $findOldLogin->oauth_client,
                ]);
            }
            // другая ошибка
            dd($e->getMessage());
        }

    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect('/login');
        } catch (Exception $e) {
            dd($e->getMessage());
        }

    }

}
