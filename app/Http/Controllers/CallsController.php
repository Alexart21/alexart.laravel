<?php

namespace App\Http\Controllers;

use App\Models\Call;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Feedback;
use App\Http\Requests\CallFormRequest;
use MoveMoveIo\DaData\Enums\Gender;
use MoveMoveIo\DaData\Enums\Parts;
use MoveMoveIo\DaData\Facades\DaDataName;
use App\Jobs\SenderCall;

class CallsController extends AppFormsController
{
    public function index()
    {
        return 'Only POST method';
    }

    public function store(CallFormRequest $request)
    {
        $data = $request->validated();

        SenderCall::dispatch($data);
        if (Call::create($data)) {
            return response()->json([
                'success' => true,
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function info(Request $request)
    {
        /*return response()->json([
            'success' => true,
            'count' => 4,
            'names' => ['вася', 'василий', 'василиса', 'васискис'],
        ]);*/
        $dadata = DaDataName::prompt($request->name, $count=5, Gender::UNKNOWN, [Parts::NAME]);
        $res = [];
        foreach ($dadata['suggestions'] as $v){
            array_push($res, $v['value']);
        }
        return response()->json([
            'success' => true,
            'count' => $count,
            'names' => $res
        ]);

    }

}
