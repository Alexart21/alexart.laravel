<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\TestFormRequest;
use App\Models\Oauth;
use App\Models\User;
use Carbon\Carbon;
use Jenssegers\Date\Date;


class TestController extends Controller
{
    public ?int $x;
    public function index()
    {
//        setlocale(LC_TIME, 'ru_RU.UTF-8');
//        Carbon::setLocale(config('app.locale'));
//        $time = Carbon::parse('2012-5-21')->locale('ru')->format('d F y');


//        Date::setLocaletLocale('ru');

//        echo Date::now()->format('l j F Y H:i:s'); // zondag 28 april 2013 21:58:16
//        $date =  Date::parse('2022-11-06 19:07:24')->isYesterday(); // вчера
//        $date =  Date::parse('2022-11-07 19:07:24')->isToday(); // сегодня
        $date = Date::parse('2022-11-05 14:07:24');

        if($date->isYesterday()){
            $date = 'вчера в ' . $date->format('H:i');
        }elseif ($date->isToday()){
            $date = 'сегодня в ' . $date->format('H:i');
        }else{
            $date = $date->format('j F Y H:i');
        }
        dd($date);
//        $x = Carbon::parse('2022-11-01 19:07:24')->diff(Carbon::now())->format('%H hours %i minutes, %s seconds');
        $x = Carbon::parse('2022-10-01 11:07:24')->diff(Carbon::now());
//        dd($date->ago());
//        dd($x);
//        echo Date::parse('2022-11-06 18:07:24')->format('l j F Y H:i'); // zondag 28 april 2013 21:58:16
        echo Date::parse('2022-11-06 18:07:24')->format('l j F Y H:i'); // zondag 28 april 2013 21:58:16

//        echo Date::parse('-1 day')->diffForHumans(); // 1 dag geleden
        die;
        $data =[];
        return view('test.index', compact('data'));
    }

    public function store(TestFormRequest $request)
    {
        $request->validated();
        return response()->json(['success' => true]);
    }
}
