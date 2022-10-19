<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    public function index()
    {
        return 'Only POST method';
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:128',
            'email' => 'email',
            'tel' => 'min:6|max:18',
            'body' => 'required|min:2|max:10000',
        ]);

        if ($validator->fails()) // не прошла валидация
        {
            return response()->json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }else{ // успех
            $data = $request->all();
            $res = Post::create($data);
            return response()->json([
                'success' => true,
                'db' => $res
            ]);
        }
    }
}
