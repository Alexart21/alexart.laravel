<?php

namespace App\Http\Controllers\Admin;

use App\Models\Content;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class DefaultController extends AppController
{
   public function index()
   {
       $pages = Content::all();
       return view('admin.index', compact('pages'));
   }

   public function cache()
   {
//       $this->clearCache(); // из родительского контроллера
       Cache::flush();
       flash('Кэш очищен')->success()->important();
       return redirect()->back();
   }

   // для всех страниц timestamp в текущее время (Для заголовка Last-Modified)
   public function last()
   {
       $this->setLastMod(); // из родительского контроллера
//       $this->clearCache(); // из родительского контроллера
       Cache::flush();
       flash('Обновлено')->success()->important();
       return redirect()->back();
   }
}
