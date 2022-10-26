<?php

namespace App\Http\Controllers\OAuth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OauthController
{

    public function redirectToService($service)
    {
        return Socialite::driver($service)->redirect();
    }

    public function handleCallback($service)
    {
        // здесь пишем в сессию чтобы не было редиректа на страницу о необходимости подтверждения email
        // для OAuth это не нужно
        // как при обычной регистрации
        // в файле app/Http/Controllers/Auth/EmailVerificationPromptController.php проверяем если true то
        // сразу редиректим на главную без всяких напоминаний о подтверждении email
        session(['is_oauth' => true]);
        $user = Socialite::driver($service)->user();
        if ($service == 'yandex') {
            $name = $user->nickname;
            $email = $user->nickname . '@yandex.ru'; // вот такая дичь
        } elseif ($service == 'odnoklassniki') {
            $name = $user->name;
            $email = 'ok_dummy_email' . time() . '@aa.aa'; // пока затык email там не дает
        } else {
            $name = $user->name;
            $email = $user->email;
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
                    'oauth_client' => $service,
                    $service . '_id' => $user->id,
                    'password' => Str::random(8),
                    'email_verified_at' => date("Y-m-d H:i:s"),
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
