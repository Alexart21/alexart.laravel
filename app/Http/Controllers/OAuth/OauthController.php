<?php

namespace App\Http\Controllers\OAuth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use App\Models\Oauth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        } elseif ($service == 'google') {
            $name = $user->name;
            $email = $user->email;
            $avatar = $user->user['picture'] ?? null;
        } elseif ($service == 'vkontakte') {
            $name = $user->name;
            $email = $user->email;
            $avatar = $user->user['photo_200'] ?? null;
        } elseif ($service == 'odnoklassniki') {
            $name = $user->name;
            $email = $user->email;
            $avatar = $user->user['pic_1'];
        } elseif ($service == 'gitgub') {
            $name = $user->name;
            $email = $user->email;
            $avatar = $user->user['avatar_url'];
        } else {
            $name = $user->name;
            $email = $user->email;
            $avatar = null;
        }
        //
        $_user = Oauth::where('source_id', $user->id)->first();
        if ($_user) { //уже заходил
            $finduser = User::findOrFail($_user->user_id);
            Auth::login($finduser);
            return redirect()->intended('dashboard');
        } else { // впервые
            try {
                DB::beginTransaction();
                $newUser = User::create([
                    'name' => $name,
                    'email' => $email,
                    'avatar' => $avatar,
                    'password' => Str::random(8),
                    'email_verified_at' => date("Y-m-d H:i:s"),
                    'ip' => session('ip'),
                ]);
                Oauth::create([
                    'user_id' => $newUser->id,
                    'source' => $service,
                    'source_id' => $user->id,
                ]);
                DB::commit();
                Auth::login($newUser);
                return redirect()->intended('dashboard');
            } catch (Exception $e) {
                DB::rollBack();
                // поскольку поле email у нас unique возможны ошибки MYSQL
                $findOldLogin = User::where('email', $user->email)->first();
                $oauth = Oauth::where('user_id', $findOldLogin->id)->first();
                if ($findOldLogin) { // юзер уже логинился через какой то сервис с таким же email
                    return view('auth.oauth-except', [
                        'id' => $findOldLogin->id,
                        'email' => $findOldLogin->email,
                        'oauth_client' => $oauth->source,
                    ]);
                }
                // другая ошибка
                dd($e->getMessage());
            }
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
