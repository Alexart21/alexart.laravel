<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\TestFormRequest;
use App\Models\Oauth;
use App\Models\User;
use Carbon\Carbon;
use Jenssegers\Date\Date;
use MoveMoveIo\DaData\Facades\DaDataAddress;
use MoveMoveIo\DaData\Enums\Language;
use MoveMoveIo\DaData\Facades\DaDataName;
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
            'count' => 3,
            'address' => ['aaaaaa', 'bbbbbbbbbbb', 'cccccccccccc']
        ]);*/
//        $dadata = DaDataAddress::standardization($request->q);
        $dadata = DaDataAddress::prompt($request->q, $count = 10, Language::RU);
//        $dadata = DaDataAddress::id($request->q);
//        $dadata = DaDataAddress::postalUnitById(127642, 2, Language::RU);
//        $dadata = DaDataPhone::standardization('раб 846)231.60.14 *139');
//        dd($dadata['suggestions'][5]['value']);
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
