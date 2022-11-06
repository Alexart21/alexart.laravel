<?php

namespace App\Http\Controllers\Admin;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class DefaultController extends AppController
{
   public function index()
   {
       $pages = Content::all();
       return view('admin.index', compact('pages'));
   }

   public function cache()
   {
       try {
           Artisan::call('cache:clear');
           Artisan::call('config:clear');
           Artisan::call('view:clear');
           Artisan::call('route:clear');
           flash('Кэш очищен')->success()->important();
       }catch (Exception $e){
           dd($e->getMessage());
       }
       return redirect()->back();
   }

   // для всех страниц timestamp в текущее время (Для заголовка Last-Modified)
   public function last()
   {
       $this->setLastMod(); // из родительского контроллера
       flash('Обновлено')->success()->important();
       return redirect()->back();
   }
}
