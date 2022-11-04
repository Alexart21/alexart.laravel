<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\TestFormRequest;
use App\Models\Oauth;
use App\Models\User;


class TestController extends Controller
{
    public ?int $x;
    public function index()
    {
        // $_user = Oauth::where('source_id', 'zzz')->first();
        // if ($_user) { //уже заходил с этим сервисом
        //     $user = $_user->user;
        //     dd($user);
        // }
        $_user = Oauth::where('source_id', 'zzz')->with('user')->first()->user;
        dd($_user);
        return view('test.index', compact('data'));
    }

    public function store(TestFormRequest $request)
    {
        $request->validated();
        return response()->json(['success' => true]);
    }
}
