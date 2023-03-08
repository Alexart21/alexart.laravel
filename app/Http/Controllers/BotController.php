<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\Telegram;

class BotController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();
        Telegram::dispatch($data);
    }
}
