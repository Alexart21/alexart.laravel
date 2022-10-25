<?php

namespace App\Http\Controllers\OAuth;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class OdnoklassnikiController extends  AppOauthController
{
    public function redirectToOk()
    {
        return Socialite::driver('odnoklassniki')->redirect();
    }

    public function handleOkCallback()
    {
        // здесь пишем в сессию чтобы не было редиректа на страницу о необходимости подтверждения email
        // для OAuth это не нужно
        // как при обычной регистрации
        // в файле app/Http/Controllers/Auth/EmailVerificationPromptController.php проверяем если true то
        // сразу редиректим на главную без всяких напоминаний о подтверждении email
        session(['is_oauth' => true]);

        $user = Socialite::driver('odnoklassniki')->user();
//            dd($user);
        try {
            $finduser = User::where('odnoklassniki_id', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);
                return redirect()->intended('dashboard');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => 'ok_dummy_email' . time() . '@aa.aa',
                    'oauth_client' => 'odnoklassniki',
                    'odnoklassniki_id' => $user->id,
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
                    'destroyUrl' => 'odnoklassniki.destroy',
                ]);
            }
            // другая ошибка
            dd($e->getMessage());
        }
    }
}
