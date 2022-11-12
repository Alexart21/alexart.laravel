<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;


class AdminPostController extends AppController
{
    const PAGE_SIZE = 2;

    public function index(Request $request)
    {
        if ($request->sort === 'new') { // только непрочитанные
            $mails = Post::where('status', Post::NEW_STATUS)->orderByDesc('created_at')->paginate(self::PAGE_SIZE);
            $count = $mails->count();
            $total = $mails->total();
            $trashed = Post::onlyTrashed()->get()->count();
            $mails->appends(['sort' => 'new']);
            $new = true;
        } else { // все сообщения
            $mails = Post::orderByDesc('created_at')->paginate(self::PAGE_SIZE);
            $count = $mails->count();
            $total = $mails->total();
            $trashed = Post::onlyTrashed()->get()->count();
            $new = false;
        }
        return view('admin.post.index', compact('mails', 'count', 'total', 'trashed', 'new'));
    }

    public function show($id)
    {
        $mail = Post::findOrFail($id);
        $mail->status = Post::READ_STATUS;
        $mail->save();
        return view('admin.post.show', compact('mail'));
    }


    public function destroy($id)
    {
        $mail = Post::findOrFail($id);
        $mail->status = Post::READ_STATUS;
        $mail->save();
        $mail->delete();
        return redirect()->route('post.index');
    }

    // все в корзину
    public function destroyAll(Request $request)
    {
        $pageNum = (int)$request->page;
        if ($request->sort === 'all') {
            $mails = Post::orderByDesc('created_at')->paginate(self::PAGE_SIZE, ['*'], 'page', $pageNum);
        } elseif ($request->sort === 'new') {
            $mails = Post::where('status', Post::NEW_STATUS)->orderByDesc('created_at')->paginate(self::PAGE_SIZE, ['*'], 'page', $pageNum);
        }
        if ($mails) {
            foreach ($mails as $mail) {
                $mail->status = Post::READ_STATUS;
                $mail->save();
                $mail->delete();
            }
        }
        return redirect()->route('post.index');
    }

    // безвозвратно очистка таблицы
    public function deleteAll()
    {
        Post::truncate();
        return redirect()->route('post.index');
    }

    public function trash()
    {
        $mails = Post::onlyTrashed()->get();
        return view('admin.post.trash', compact('mails'));
    }

    public function restore($id)
    {
        $mail = Post::onlyTrashed()->findOrFail($id);
        $mail->restore();
        return redirect()->route('post.index');
    }

    public function destroyForewer($id)
    {
        Post::onlyTrashed()->findOrFail($id)->forceDelete();
        return redirect()->route('post.index');
    }

    public function clearTrash()
    {
        Post::onlyTrashed()->forceDelete();
        return redirect()->route('post.index');
    }

}
