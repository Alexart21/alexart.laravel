<?php
namespace App\Http\Controllers\Admin;

use App\Models\Call;
use App\Models\Post;


class AdminPostController extends AppController
{

    public function index()
    {
//        $mails = Post::all();
        $mails = Post::orderByDesc('created_at')->paginate(20);
        $count = $mails->count();
        $total = $mails->total();
        $trashed = Post::onlyTrashed()->get()->count();
//        dd($pages);
        return view('admin.post.index', compact('mails', 'count', 'total', 'trashed'));
    }

    public function show($id)
    {
        $mail = Post::findOrFail($id);
        $mail->is_read = 1;
        $mail->save();
        // сдесь поскольку мы минуем middlware CheckisAdmin где устанавливаются значения
        // то приходиться вручную
        session([
            'msgs' => [
                'allCalls' => Call::count(),
                'newCalls' => Call::where('is_read', 0)->count(),
                'allPosts' => Post::count(),
                'newPosts' => Post::where('is_read', 0)->count(),
            ],
        ]);
        return view('admin.post.show', compact('mail'));
    }


    public function destroy($id)
    {
        $mail = Post::findOrFail($id);
        $mail->is_read = 1;
        $mail->save();
        $mail->delete();
        return redirect()->route('post.index');
    }

    // все в корзину
    public function destroyAll()
    {
        $mails = Post::all();
        foreach ($mails as $mail){
            $mail->is_read = 1;
            $mail->save();
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
