<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests\IndexFormRequest;
use App\Models\Post;


class AdminPostController extends AppController
{

    public function index()
    {
        $mails = Post::all();
        $count = $mails->count();
        $trashed = Post::onlyTrashed()->get()->count();
//        dd($pages);
        return view('admin.post.index', compact('mails', 'count', 'trashed'));
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

    // все в корзину
    public function destroyAll()
    {
        $mails = Post::all();
        foreach ($mails as $mail){
            $mail->delete();
        }
        return redirect()->route('post.index');
    }

    // безвозвратно очистка таблицы
    public function deleteAll()
    {
        Post::truncate();
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

    public function clearTrash()
    {
        Post::onlyTrashed()->forceDelete();
        return redirect()->route('post.index');
    }

}
