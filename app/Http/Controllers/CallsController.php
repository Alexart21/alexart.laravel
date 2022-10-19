<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Call;
use Illuminate\Support\Facades\Validator;

class CallsController extends Controller
{
    public function index()
    {
        return view('call.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:128',
            'tel' => 'min:6|max:18',
        ]);

        if ($validator->fails()) // не прошла валидация
        {
            return response()->json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }else{ // успех
            $data = $request->all();
            Call::create($data);
            return response()->json([
                'success' => true,
            ]);
        }
    }
}
