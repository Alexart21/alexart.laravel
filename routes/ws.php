<?php
use App\Events\SendMessage;
use BeyondCode\LaravelWebSockets\Apps\AppProvider;
use BeyondCode\LaravelWebSockets\Dashboard\DashboardLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    $message = $request->message;
    $name = $request->name ?? "Anonymous";
    $time = (new DateTime(now()))->format(DATE_ATOM);
    SendMessage::dispatch($name, $message, $time);
});
