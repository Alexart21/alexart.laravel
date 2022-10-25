<?php
namespace App\Http\Controllers\OAuth;

use App\Http\Controllers\Controller;
use App\Models\User;


class AppOauthController extends Controller
{

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/login');
    }

}
