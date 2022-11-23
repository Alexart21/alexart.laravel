<?php

namespace App\Http\Controllers\Admin;

use App\Models\Content;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ContentFormRequest;

class AdminContentController extends AppController
{
    const PAGE_SIZE = 20;

    public function index()
    {
//        $pages = Content::all();
        $pages = Content::orderByDesc('created_at')->paginate(self::PAGE_SIZE);
        $count = $pages->count();
        $total = $pages->total();
        $trashed = Content::onlyTrashed()->get()->count();
//        dd($pages);
        return view('admin.content.index', compact('pages', 'total', 'count',  'trashed'));
    }

    public function create()
    {
        return view('admin.content.create');
    }


    public function store(ContentFormRequest $request)
    {
        $data = $request->validated();
        $page = Content::create($data);
        return redirect()->route('content.show', [ $page->id ]);
    }


    public function show($id)
    {
        $page = Content::findOrFail($id);
        return view('admin.content.show', compact('page'));
    }

    public function edit($id)
    {
        $page = Content::findOrFail($id);
        return view('admin.content.edit', compact('page'));
    }


    public function update(ContentFormRequest $request, $id)
    {
        $data = $request->validated();
        try {
            $page = Content::findOrFail($id);
            $page->update($data);
            flash('Обновлено !')->success();
        }catch (Exception $e){
            flash($e->getMessage())->error();
        }

        return redirect()->route('content.show', [ $id ]);
    }

    public function destroy($id)
    {
       $page = Content::findOrFail($id);
       $page->delete();
       return redirect()->route('content.index');
    }

    public function trash(){
        $pages = Content::onlyTrashed()->get();
        return view('admin.content.trash', compact('pages'));
    }

    public function restore($id){
        $page = Content::onlyTrashed()->findOrFail($id);
        $page->restore();
        return redirect()->route('content.index');
    }

    public function destroyForewer($id){
        Content::onlyTrashed()->findOrFail($id)->forceDelete();
        return redirect()->route('content.index');
    }
}
