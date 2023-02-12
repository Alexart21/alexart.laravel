<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\Support\Facades\Cache;

class AdminContentEditableController extends Controller
{
    public function index($id)
    {
        $data = Content::findOrFail($id);
        return view('admin.content.contenteditable', compact('data'));
    }

    public function store(Request $request)
    {
        $id = (int)$request->id;
        $data = $request->data;
        try {
            $page = Content::findOrFail($id);
            $page->page_text = $data;
            $page->save();
            Cache::flush();
            return response()->json([
                'success' => true,
                'id' => $id,
            ]);
        }catch (Exception $e){
            dd($e->getMessage());
        }
    }
}
