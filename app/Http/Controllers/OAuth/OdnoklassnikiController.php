<?php
namespace App\Http\Controllers\OAuth;

use Illuminate\Http\Request;
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
        try {
            $user = Socialite::driver('odnoklassniki')->user();
//            dd($user);
            $finduser = User::where('odnoklassniki_id', $user->id)->first();
            if($finduser){
                Auth::login($finduser);
                return redirect()->intended('dashboard');
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => 'ok_dummy_email' . time() . '@aa.aa',
                    'odnoklassniki_id'=> $user->id,
                    'password' => encrypt('hjhf3kr@87tgvalu')
                ]);
                Auth::login($newUser);
                return redirect()->intended('dashboard');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
