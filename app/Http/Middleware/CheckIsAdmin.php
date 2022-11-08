<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        /*DB::beforeExecuting(function($query){
            echo  "<pre>$query</pre>";
        });*/
        session([
            'msgs' => [
                'allCalls' => Call::count(),
                'newCalls' => Call::where('is_read', 0)->count(),
                'allPosts' => Post::count(),
                'newPosts' => Post::where('is_read', 0)->count(),
            ],
        ]);
        return $next($request);
    }
}
