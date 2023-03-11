<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\Telegram;
use Illuminate\Support\Facades\Log;
use App\Helpers\TG;

class BotController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();
//        Log::debug($data);
        Telegram::dispatch($data);
    }
}
