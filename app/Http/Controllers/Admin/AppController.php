<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\Support\Facades\Artisan;

class AppController extends Controller
{
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
            Artisan::call('cache:clear');
        }catch (Exception $e){
            dd($e->getMessage());
        }
    }
}
