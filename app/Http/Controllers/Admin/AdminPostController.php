<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests\IndexFormRequest;
use App\Models\Post;


class AdminPostController extends AppController
{

    public function index()
    {
        $mails = Post::all();
        $trashed = Post::onlyTrashed()->get()->count();
//        dd($pages);
        return view('admin.post.index', compact('mails', 'trashed'));
    }

    public function show($id)
    {
        $mail = Post::findOrFail($id);
        return view('admin.post.show', compact('mail'));
    }


    public function destroy($id)
    {
        $mail = Post::findOrFail($id);
        $mail->delete();
        return redirect()->route('post.index');
    }

    public function trash(){
        $mails = Post::onlyTrashed()->get();
        return view('admin.post.trash', compact('mails'));
    }

    public function restore($id){
        $mail = Post::onlyTrashed()->findOrFail($id);
        $mail->restore();
        return redirect()->route('post.index');
    }

    public function destroyForewer($id){
        Post::onlyTrashed()->findOrFail($id)->forceDelete();
        return redirect()->route('post.index');
    }

}
