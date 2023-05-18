<?php

namespace App\Http\Controllers;

class SeoController extends Controller
{
    public function index()
    {
        return view('content.seo_pages.index');
    }

    public function speed()
    {
        return view('content.seo_pages.speed');
    }

    public function tech()
    {
        return view('content.seo_pages.tech');
    }

    public function semantic()
    {
        return view('content.seo_pages.semantic');
    }
}
