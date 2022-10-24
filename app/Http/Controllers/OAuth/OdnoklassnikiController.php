<?php

namespace App\Http\Controllers\OAuth;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class OdnoklassnikiController extends Controller
{
    public function redirectToOk()
    {
        return Socialite::driver('odnoklassniki')->redirect();
    }

    public function handleOkCallback()
    {
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

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/login');
    }
}
