<?php

namespace App\Http\Controllers\Admin;

use App\Models\Call;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;


class AdminCallController extends AppController
{

    const PAGE_SIZE = 20;

    public function index(Request $request)
    {
        if ($request->sort === 'new') { // только непрочитанные
            $calls = Call::where('status', Call::NEW_STATUS)->orderByDesc('created_at')->paginate(self::PAGE_SIZE);
            $count = $calls->count();
            $total = $calls->total();
            $trashed = Call::onlyTrashed()->get()->count();
            $calls->appends(['sort' => 'new']);
            $new = true;
        } else { // все сообщения
            $calls = Call::orderByDesc('created_at')->paginate(self::PAGE_SIZE);
            $count = $calls->count();
            $total = $calls->total();
            $trashed = Call::onlyTrashed()->get()->count();
            $new = false;
        }
        return view('admin.call.index', compact('calls', 'count', 'total', 'trashed', 'new'));
    }

    public function show($id)
    {
//        dd($id);
        $call = Call::findOrFail($id);
        $call->status = Call::READ_STATUS;
        $call->save();
        return view('admin.call.show', compact('call'));
    }


    // в корзину
    public function destroy($id)
    {
        $call = Call::findOrFail($id);
        $call->status = Call::READ_STATUS;
        $call->save();
        $call->delete();
        return redirect()->route('call.index');
    }

    // все в корзину
    public function destroyAll(Request $request)
    {
        $pageNum = (int)$request->page;
        // получаем данные по номеру страницы
        if($request->sort === 'all'){
            $calls = Call::orderByDesc('created_at')->paginate(self::PAGE_SIZE, ['*'], 'page', $pageNum);
        }elseif ($request->sort === 'new'){
            $calls = Call::where('status', Call::NEW_STATUS)->orderByDesc('created_at')->paginate(self::PAGE_SIZE, ['*'], 'page', $pageNum);
        }
        if($calls){
            foreach ($calls as $call) {
                $call->status = Call::READ_STATUS;
                $call->save();
                $call->delete();
            }
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

    // безвозвратное удаление
    public function destroyForewer($id)
    {
        // метод вызывается и из корзины и из стандартного вида поэтому withTrashed()
        Call::withTrashed()->findOrFail($id)->forceDelete();
        return redirect()->route('call.index');
    }

    public function clearTrash()
    {
        Call::onlyTrashed()->forceDelete();
        return redirect()->route('call.index');
    }

}
