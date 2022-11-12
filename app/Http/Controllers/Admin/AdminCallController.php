<?php

namespace App\Http\Controllers\Admin;

use App\Models\Call;
use App\Models\Post;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;


class AdminCallController extends AppController
{

    // все сообщения
    public function index(Request $request)
    {
        if ($request->s === 'new') { // только непрочитанные
            $query = Call::where('status', Call::NEW_STATUS);
            $calls = $query->orderByDesc('created_at')->paginate(20);
            $count = $query->count();
            $total = $calls->total();
            $trashed = Call::onlyTrashed()->get()->count();
            $new = true;
        } else { // все
            $calls = Call::orderByDesc('created_at')->paginate(20);
            $count = $calls->count();
            $total = $calls->total();
            $trashed = Call::onlyTrashed()->get()->count();
            $new = false;
        }
        return view('admin.call.index', compact('calls', 'count', 'total', 'trashed', 'new'));
    }

    public function show($id)
    {
        $call = Call::findOrFail($id);
        $call->status = Call::READ_STATUS;
        $call->save();
        return view('admin.call.show', compact('call'));
    }


    public function destroy($id)
    {
        $call = Call::findOrFail($id);
        $call->status = Call::READ_STATUS;
        $call->save();
        $call->delete();
        return redirect()->route('call.index');
    }

    // все в корзину
    public function destroyAll()
    {
        $calls = Call::all();
        foreach ($calls as $call) {
            $call->status = Call::READ_STATUS;
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

    public function trash()
    {
        $calls = Call::onlyTrashed()->get();
        return view('admin.call.trash', compact('calls'));
    }

    public function restore($id)
    {
        $call = Call::onlyTrashed()->findOrFail($id);
        $call->restore();
        return redirect()->route('call.index');
    }

    public function destroyForewer($id)
    {
        Call::onlyTrashed()->findOrFail($id)->forceDelete();
        return redirect()->route('call.index');
    }

    public function clearTrash()
    {
        Call::onlyTrashed()->forceDelete();
        return redirect()->route('call.index');
    }

}
