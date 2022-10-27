<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\TestFormRequest;


class TestController extends Controller
{
    public ?int $x;
    public function index()
    {
        $this->x = null;
        $data = [];
        return view('test.index', compact('data'));
    }

    public function store(TestFormRequest $request)
    {
        $data = $request->validated();
        return 'ok';
    }
}
