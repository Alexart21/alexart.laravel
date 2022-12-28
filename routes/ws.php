<?php
use App\Events\SendMessage;
use BeyondCode\LaravelWebSockets\Apps\AppProvider;
use BeyondCode\LaravelWebSockets\Dashboard\DashboardLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Jenssegers\Date\Date;

Route::get('/wschat', function (AppProvider $appProvider) {
    return view('content.wschat', [
        "port" => "6001",
        "host" => "127.0.0.1",
        "authEndpoint" => "/api/sockets/connect",
        "logChannel" => DashboardLogger::LOG_CHANNEL_PREFIX,
        "apps" => $appProvider->all()
    ]);
});

Route::post("/chat/send", function(Request $request) {
    $message =$request->message;
    $name = $request->name ?? "Anonymous";
//    $time = Date::now()->format('H:i');
    $time = Date::now();
    if($time->isYesterday()){
        $time = 'вчера в ' . $time->format('H:i');
    }elseif ($time->isToday()){
        $time = $time->format('H:i');
    }else{
        $time = $time->format('j F Y H:i');
    }
    SendMessage::dispatch($name, $message, $time);
});
