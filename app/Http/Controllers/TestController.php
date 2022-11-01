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
        // реализована связь один к одному
        $_user = Oauth::where('source_id', '1111')->first();
        if($_user){
            $_user = $_user->user;
        }else{
            dd('NEW user create...');
        }
        dd($_user);
        $data = [];
        return view('test.index', compact('data'));
    }

    public function store(TestFormRequest $request)
    {
        $data = $request->validated();
        return 'ok';
    }
}
