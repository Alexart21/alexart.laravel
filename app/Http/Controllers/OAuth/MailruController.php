<?php
namespace App\Http\Controllers\OAuth;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class MailruController extends Controller
{
    public function redirectToMailru()
    {
        return Socialite::driver('mailru')->redirect();
    }

    public function handleMailruCallback()
    {
        try {
            $user = Socialite::driver('mailru')->user();
            dd($user);
            $finduser = User::where('mailru_id', $user->id)->first();
            if($finduser){
                Auth::login($finduser);
                return redirect()->intended('dashboard');
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'mailru_id'=> $user->id,
                    'password' => encrypt('hjjjkr@87tgvalu')
                ]);
                Auth::login($newUser);
                return redirect()->intended('dashboard');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
