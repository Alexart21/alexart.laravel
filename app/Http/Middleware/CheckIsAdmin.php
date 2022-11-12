<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Models\Call;
use App\Models\Post;

class CheckIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {

        if(!Auth::user()->isAdmin()){
//            die('here');
            return redirect('/');
        }
        $callNewStatus = Call::NEW_STATUS;
        $postNewStatus = Post::NEW_STATUS;
        // что необходимо в шаблоне берем из базы
        // Впихнул в UNION
        $results = DB::select(
            "SELECT COUNT(*) FROM `calls`
    UNION ALL SELECT COUNT(*) FROM `calls` WHERE status = $callNewStatus
    UNION ALL SELECT COUNT(*) FROM `posts`
    UNION ALL SELECT COUNT(*) FROM `posts` WHERE status = $postNewStatus
    ");
        // значения доставать из Std класса таким черезж способом
        foreach ($results as $res) {
            foreach ($res as $item) {
                $x[] = $item;
            }
        }
        // без Union 4 запроса
        /*$msgs => [
       'allCalls' => Call::count(),
       'newCalls' => Call::where('is_read', 0)->count(),
       'allPosts' => Post::count(),
       'newPosts' => Post::where('is_read', 0)->count(),
       ],*/
        $msgs = [
            'allCalls' => $x[0],
            'newCalls' => $x[1],
            'allPosts' => $x[2],
            'newPosts' => $x[3],
        ];
        $user = Auth::user();
        if($user){
            if($user->profile_photo_path){
                $avatar = '/storage/' . $user->profile_photo_path;
            }elseif ($user->avatar){
                $avatar = $user->avatar;
            }else{
                $avatar = '/upload/default_avatar/no-image.png';
            }
        }
        // Расшариваем нужные данные
        View::share([
            'msgs' => $msgs,
            'username' => $user->name,
            'avatar' => $avatar,
        ]);
        /*DB::beforeExecuting(function($query){
            echo  "<pre>$query</pre>";
        });*/
        return $next($request);
    }
}
