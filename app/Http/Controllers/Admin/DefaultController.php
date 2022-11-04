<?php

namespace App\Http\Controllers\Admin;

use App\Models\Content;
use Illuminate\Http\Request;

class DefaultController extends AppController
{
   public function index()
   {
       $pages = Content::all();
       return view('admin.index', compact('pages'));
   }
}
