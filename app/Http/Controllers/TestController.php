<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\TestFormRequest;
use App\Models\Oauth;
use App\Models\User;
use Carbon\Carbon;
use Jenssegers\Date\Date;
use App\Models\Content;

use MoveMoveIo\DaData\Facades\DaDataAddress;
use MoveMoveIo\DaData\Enums\Language;
use MoveMoveIo\DaData\Facades\DaDataName;
use MoveMoveIo\DaData\Enums\Gender;
use MoveMoveIo\DaData\Enums\Parts;
use MoveMoveIo\DaData\DaDataPhone;
use App\Jobs\TestJob;
use Iman\Streamer\VideoStreamer;


class TestController extends Controller
{
    // public ?int $x;
    public function index(Request $request)
    {
        $count = session('count');
        dump($count);
        $count = $count ? $count + 1 : 1;
        session(['count' => $count]);
        dump(session('count'));
        $data =[];
        $msg = 'msg ' . $count;
//        die('here');
        // очереди
       TestJob::dispatch($msg);
        //

        return view('test.index', compact('data'));
    }

    public function store(TestFormRequest $request)
    {
        $request->validated();
        return response()->json(['success' => true]);
    }

    public function save(Request $request)
    {
//        die('here');
        dd($request->q);
    }

    public function dadata()
    {
        return view('test.dadata');
    }

    public function address()
    {
//        $dadata = DaDataAddress::standardization('новы');
//        dd($dadata[0]['result']);

        return view('test.address');
    }

    public function info(Request $request)
    {

        /*return response()->json([
            'success' => true,
            'count' => 2,
            'address' => ['aaaa', 'bla-bka-bla-la-LA'],
        ]);*/

//        $dadata = DaDataName::prompt($request->q, $count=5, Gender::UNKNOWN, [Parts::NAME]);
        $dadata = DaDataAddress::prompt($request->q, $count = 10, Language::RU);
        $res = [];
        foreach ($dadata['suggestions'] as $v){
            array_push($res, $v['value']);
        }
//        dd($res);
        return response()->json([
            'success' => true,
            'count' => $count,
            'address' => $res
        ]);

    }

    public function confirm()
    {
        return view('test.confirm', ['success' => false]);
    }

    public function confirmStore(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);
        flash('Успешно !!!');
        return view('test.confirm', ['success' => true]);
    }

    public function form()
    {
        return view('test.form');
    }

    public function download()
    {
        return response()->download('sitemap.xml');
    }

    public function videopage()
    {
        return view('test.videopage');
    }

    // stream
    public function video()
    {
        $path = public_path('storage/files/_video.mp4');
        VideoStreamer::streamFile($path);
    }
}
