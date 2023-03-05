<?php

namespace App\Http\Controllers;
use App\Models\Content;
use Illuminate\Support\Facades\Cache;
use App\Events\GetInPortfolioPage;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public $page; // страница 'sozdanie', 'parsing' и.т.п

    public function index()
    {
        //15552000 - 180 суток
        $data = Cache::remember('index', 15552000, function () {
            return Content::where('page', 'index')->firstOrFail();
        });
//        $data = Content::where('page', 'index')->firstOrFail();
        return response()
            ->view('content.index', compact('data'))
            ->header('Last-Modified', gmdate("D, d M Y H:i:s \G\M\T", $data->updated_at->timestamp))
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate');
    }

    public function page(Request $request, $page)
    {
        $this->page = $page;
        $data = Cache::remember($page, 15552000, function () {
            return Content::where('page', $this->page)->firstOrFail();
        });
//        $data = Content::where('page', $this->page)->firstOrFail();
        // событие проверка. Там отправка сообщения на TG канал
        if($page === 'portfolio'){
            event(new GetInPortfolioPage($request->ip()));
        }
        return response()
            ->view('content.page', compact('data'))
            ->header('Last-Modified', gmdate("D, d M Y H:i:s \G\M\T", $data->updated_at->timestamp))
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate');
    }

    public function nodechat()
    {
        return view('content.nodechat');
    }

    public function chat()
    {
        return view('content.chat');
    }
}
