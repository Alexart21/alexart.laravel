<?php
namespace App\Http\Controllers\Admin;

use App\Models\Call;
use App\Models\Post;


class AdminCallController extends AppController
{

    public function index()
    {
        $calls = Call::orderByDesc('updated_at')->paginate(20);
        $count = $calls->count();
        $total = $calls->total();
        $trashed = Call::onlyTrashed()->get()->count();
        return view('admin.call.index', compact('calls', 'count', 'total', 'trashed'));
    }

    public function show($id)
    {
        $call = Call::findOrFail($id);
        $call->is_read = 1;
        $call->save();
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
        return view('admin.call.show', compact('call'));
    }


    public function destroy($id)
    {
        $call = Call::findOrFail($id);
        $call->is_read = 1;
        $call->save();
        $call->delete();
        return redirect()->route('call.index');
    }

    // все в корзину
    public function destroyAll()
    {
        $calls = Call::all();
        foreach ($calls as $call){
            $call->is_read = 1;
            $call->save();
            $call->delete();
        }
        return redirect()->route('call.index');
    }

    // безвозвратно очистка таблицы
    public function deleteAll()
    {
        Call::truncate();
        return redirect()->route('call.index');
    }

    public function trash(){
        $calls = Call::onlyTrashed()->get();
        return view('admin.call.trash', compact('calls'));
    }

    public function restore($id){
        $call = Call::onlyTrashed()->findOrFail($id);
        $call->restore();
        return redirect()->route('call.index');
    }

    public function destroyForewer($id){
        Call::onlyTrashed()->findOrFail($id)->forceDelete();
        return redirect()->route('call.index');
    }

    public function clearTrash()
    {
        Call::onlyTrashed()->forceDelete();
        return redirect()->route('call.index');
    }

}
