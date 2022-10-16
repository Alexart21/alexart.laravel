<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\Support\Facades\Cache;
use App\Models\Post;

class ContentController extends Controller
{
    public $page; // страница 'sozdanie', 'parsing' и.т.п

    public function index()
    {
        /*$data = Cache::remember('index', 600, function () {
            return Content::where('page', 'index')->firstOrFail();
        });*/
        $data = Content::where('page', 'index')->firstOrFail();
        view()->share(['title' => $data->title]);
        return view('content.index', compact('data'));
    }

    public function page($page)
    {
        $this->page = $page;
        /*$data = Cache::remember($page, 600, function () {
            return Content::where('page', $this->page)->firstOrFail();
        });*/
        $data = Content::where('page', $this->page)->firstOrFail();
        return view('content.page', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:128',
            'email' => 'required|email|unique:posts',
//            'tel' => 'min:6|max:15',
            'body' => 'required|min:2|max:10000',
        ]);

        $data = $request->all();
        Post::create($data);
        return redirect()->route('content.index');
    }
}
