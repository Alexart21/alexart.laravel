<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexFormRequest;
use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\Support\Facades\Cache;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class ContentController extends Controller
{
    public $page; // страница 'sozdanie', 'parsing' и.т.п

    public function index()
    {
        /*$data = Cache::remember('index', 600, function () {
            return Content::where('page', 'index')->firstOrFail();
        });*/
        $data = Content::where('page', 'index')->firstOrFail();
        view()->share(['data' => $data]);
//        return view('content.index', compact('data'));
        return response()
            ->view('content.index', compact('data'))
            ->header('Last-Modified:', gmdate("D, d M Y H:i:s \G\M\T", $data['last_mod']));
    }

    public function page($page)
    {
        $this->page = $page;
        /*$data = Cache::remember($page, 600, function () {
            return Content::where('page', $this->page)->firstOrFail();
        });*/
        $data = Content::where('page', $this->page)->firstOrFail();
        view()->share(['data' => $data]);
//        return view('content.page', compact('data'));
        return response()
            ->view('content.page', compact('data'))
            ->header('Last-Modified:', gmdate("D, d M Y H:i:s \G\M\T", $data['last_mod']));
    }

    /*public function store(IndexFormRequest $request)
    {
        $data = $request->validated();
        Post::create($data);
        return redirect()->route('content.index');
    }*/

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
            Post::create($data);
            return response()->json([
                'success' => true,
            ]);
        }
    }
}
