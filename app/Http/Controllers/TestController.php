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


class TestController extends Controller
{
    public ?int $x;
    public function index()
    {
        $data =[];
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
        $dadata = DaDataName::prompt($request->q, $count=5, Gender::UNKNOWN, [Parts::NAME]);
//        $dadata = DaDataAddress::prompt($request->q, $count = 10, Language::RU);
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
}
