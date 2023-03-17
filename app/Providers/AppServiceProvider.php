<?php

namespace App\Providers;

use http\Env\Url;
use Illuminate\Pagination\Paginator;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Illuminate\Support\Facades\Blade;
use DOMDocument;
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
            return Limit::perMinute(config('app.all_forms_rate_limit'))->by($request->ip());
        });

        RateLimiter::for('loginLimit', function (Request $request) {
            return Limit::perMinute(config('app.all_forms_rate_limit'))->by($request->ip())->response(function () {
                throw new TooManyRequestsHttpException();
            });
        });

        /*RateLimiter::for('loginLimit', function (Request $request) {
            return Limit::perMinute(env('AUTH_FORMS_RATE_LIMIT', 5))->by($request->ip());
        });*/

        /*DB::beforeExecuting(function($query){
            echo  "<pre>$query</pre>";
        });*/
//        setlocale(LC_ALL, 'ru_RU.utf8');
//        Paginator::useBootstrapFive();
        Blade::directive('svg', function ($arguments) {
            try {
                // Funky madness to accept multiple arguments into the directive
                list($path, $class) = array_pad(explode(',', trim($arguments, "() ")), 2, '');
                $path = trim($path, "' ");
                $class = trim($class, "' ");
                // Create the dom document as per the other answers
                $svg = new DOMDocument();
                $svg->load(public_path($path));
                $svg->documentElement->setAttribute("class", $class);
                $output = $svg->saveXML($svg->documentElement);
                return $output;
            } catch (Exception $e) {
                echo "<h3 style='color:red'>Возможно неверный путь к SVG иконке</h3>";
                die;
//                echo "<h3>__FILE__</h3>";
//                die($e);
            }
        });
    }
}
