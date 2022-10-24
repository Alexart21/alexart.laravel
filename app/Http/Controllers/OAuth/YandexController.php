<?php
namespace App\Http\Controllers\OAuth;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class YandexController extends Controller
{

    public function redirectToYandex()
    {
        return Socialite::driver('yandex')->redirect();
    }

    public function handleYandexCallback()
    {
        try {
            $user = Socialite::driver('yandex')->user();
//            dd($user);
            $finduser = User::where('yandex_id', $user->id)->first();
            if($finduser){
                Auth::login($finduser);
                return redirect()->intended('dashboard');
            }else{
                $newUser = User::create([
                    'name' => $user->nickname,
                    'email' => $user->nickname . '@yandex.ru', // вот такая дичь
                    'yandex_id'=> $user->id,
                    'password' => encrypt('Gfsb65$gghj')
                ]);
                Auth::login($newUser);
                return redirect()->intended('dashboard');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

}
