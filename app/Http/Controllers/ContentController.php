<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexFormRequest;
use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\Support\Facades\Cache;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ContentController extends Controller
{
    public $page; // страница 'sozdanie', 'parsing' и.т.п

    public function index()
    {
        //15552000 - 180 суток
       /* $data = Cache::remember('index', 15552000, function () {
            return Content::where('page', 'index')->firstOrFail();
        });*/
        $data = Content::where('page', 'index')->firstOrFail();
        return response()
            ->view('content.index', compact('data'))
            ->header('Last-Modified', gmdate("D, d M Y H:i:s \G\M\T", $data->updated_at->timestamp))
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate');
    }

    public function page($page)
    {
        $this->page = $page;
        $data = Cache::remember($page, 15552000, function () {
            return Content::where('page', $this->page)->firstOrFail();
        });
//        $data = Content::where('page', $this->page)->firstOrFail();
        view()->share(['data' => $data]);
//        return view('content.page', compact('data'));
        return response()
            ->view('content.page', compact('data'))
            ->header('Last-Modified', gmdate("D, d M Y H:i:s \G\M\T", $data->updated_at->timestamp))
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate');
    }
}
