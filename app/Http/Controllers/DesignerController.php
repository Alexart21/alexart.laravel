<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DesignerController extends Controller
{
   public function index()
   {
       setcookie('csrf', csrf_token());
       return view('content.designer');
   }

   public function store(Request $request)
   {
//       dd($request->screen);
       $request->validate([
           'screen' => 'file|image|mimes:png|max:200',
       ]);
       $path = $request->file('screen')->store('public/photos/screenshots');
       return response()->json([
           'success' => true,
           'path' => $path,
       ]);
   }
}
