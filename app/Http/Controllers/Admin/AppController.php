<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class AppController extends Controller
{
    protected function clearCache()
    {
        try {
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('view:clear');
            Artisan::call('route:clear');
        }catch (Exception $e){
            dd($e->getMessage());
        }
    }

    // для всех страениц timestamp в текущее время (Для заголовка Last-Modified)
    protected function setLastMod()
    {
        $pages = Content::all();
        try{
            foreach ($pages as $page) {
                $time = time() - rand(60, 300); // разброс от 1 до 5 минут
                $page->last_mod = gmdate("D, d M Y H:i:s \G\M\T", $time);
                $page->save();
            }
            Cache::flush();
        }catch (Exception $e){
            dd($e->getMessage());
        }
    }
}
