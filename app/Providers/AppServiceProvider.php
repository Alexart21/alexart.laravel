<?php

namespace App\Providers;

use http\Env\Url;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        RateLimiter::for('formsLimit', function (Request $request) {
            return Limit::perMinute(env('All_FORMS_RATE_LIMIT', 10))->by($request->ip());
        });

        RateLimiter::for('loginLimit', function (Request $request) {
            return Limit::perMinute(env('All_FORMS_RATE_LIMIT', 10))->by($request->ip())->response(function() {
                throw new TooManyRequestsHttpException();
            });
        });

        /*RateLimiter::for('loginLimit', function (Request $request) {
            return Limit::perMinute(env('AUTH_FORMS_RATE_LIMIT', 5))->by($request->ip());
        });*/

        /*DB::beforeExecuting(function($query){
            echo  "<pre>$query</pre>";
        });*/
    }
}
