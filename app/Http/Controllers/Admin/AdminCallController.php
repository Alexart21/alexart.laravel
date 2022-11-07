<?php
namespace App\Http\Controllers\Admin;

use App\Models\Call;
use Illuminate\Support\Carbon;


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
        return view('admin.call.show', compact('call'));
    }


    public function destroy($id)
    {
        $call = Call::findOrFail($id);
        $call->delete();
        return redirect()->route('call.index');
    }

    // все в корзину
    public function destroyAll()
    {
        $calls = Call::all();
        foreach ($calls as $call){
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
