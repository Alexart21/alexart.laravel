<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

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
            DB::beginTransaction();
            foreach ($pages as $page) {
                $time = time() - rand(60, 300); // разброс от 1 до 5 минут
                // mysql сама формирует дату в поле timestamp
                $page->updated_at = $time;
                $page->save();
            }
            DB::commit();
            Cache::flush();
        }catch (Exception $e){
            DB::rollBack();
            dd($e->getMessage());
        }
    }
}
