<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use App\Http\Requests\Admin\AjaxSaveRequest;
use App\Models\Content;
use Illuminate\Support\Facades\Cache;

class AdminContentEditableController extends Controller
{
    public function index($id)
    {
        $data = Content::findOrFail($id);
        return view('admin.content.contenteditable', compact('data'));
    }

    public function store(AjaxSaveRequest $request)
    {
        $data = $request->validated();
        try {
            $page = Content::findOrFail($data['id']);
            $page->page_text = $data['data'];
            $page->save();
            Cache::flush();
            return response()->json([
                'success' => true,
                'id' => $data['id'],
            ]);
        }catch (Exception $e){
            dd($e->getMessage());
        }
    }
}
