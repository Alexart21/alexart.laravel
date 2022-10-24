<?php
namespace App\Http\Controllers\OAuth;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class VkontakteController extends Controller
{
    public function redirectToVk()
    {
        return Socialite::driver('vkontakte')->redirect();
    }

    public function handleVkCallback()
    {
        try {
            $user = Socialite::driver('vkontakte')->user();
//            dd($user);
            $finduser = User::where('vkontakte_id', $user->id)->first();
            if($finduser){
                Auth::login($finduser);
                return redirect()->intended('dashboard');
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'vkontakte_id'=> $user->id,
                    'password' => encrypt('hjjdfgcpu')
                ]);
                Auth::login($newUser);
                return redirect()->intended('dashboard');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
