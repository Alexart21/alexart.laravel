<?php

namespace App\Http\Controllers;

use App\Http\Requests\DesignerFormRequest;

class DesignerController extends Controller
{
   public function index()
   {
       // кука читается уже в скомпилированнном vue (app.js)
       setcookie('csrf', csrf_token());
       return view('content.designer');
   }

   public function store(DesignerFormRequest $request)
   {
       $request->validated();
       $path = $request->file('screen')->store('public/photos/screenshots');
       return response()->json([
           'success' => true,
           'path' => $path,
       ]);
   }
}
