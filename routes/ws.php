<?php
use App\Events\SendMessage;
use BeyondCode\LaravelWebSockets\Apps\AppProvider;
use BeyondCode\LaravelWebSockets\Dashboard\DashboardLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Jenssegers\Date\Date;
use App\Models\Wschat;

Route::get('/wschat', function (AppProvider $appProvider) {
    /*if(extension_loaded('sockets')) echo "WebSockets OK";
    else echo "WebSockets UNAVAILABLE";
    die;*/
    return view('content.wschat', [
        "port" => "6001",
        "host" => "127.0.0.1",
        "authEndpoint" => "/api/sockets/connect",
        "logChannel" => DashboardLogger::LOG_CHANNEL_PREFIX,
        "apps" => $appProvider->all()
    ]);
});

Route::post("/chat/send", function(Request $request) {
    // вариант без записи в базу
   /* $message =$request->message;
    $name = $request->name ?? "Anonymous";
    $time = Date::now();
    if($time->isYesterday()){
        $time = 'вчера в ' . $time->format('H:i');
    }elseif ($time->isToday()){
        $time = $time->format('H:i');
    }else{
        $time = $time->format('j F Y H:i');
    }
    SendMessage::dispatch($name, $message, $time);*/

    // вариант с записью в базу
    /*$ip = $request->ip();
    $message =$request->message;
    $name =$request->name;
    $msg = new Wschat();
    if($name){
        $msg->name = $name;
    }
    $msg->msg = $message;
    $msg->ip = $ip;
    $res = $msg->save();*/
    $ip = $request->ip();
    $data = $request->validate([
        'name' => 'nullable|max:30',
        'msg' => 'required:max:500',
        'color' => 'nullable|max:10',
    ]);
    $data['ip'] = $ip;
    $msg = Wschat::create($data);
    if($msg){
        $time = Date::parse($msg->created_at);
        if($time->isYesterday()){
            $time = 'вчера в ' . $time->format('H:i');
        }elseif ($time->isToday()){
            $time = $time->format('H:i');
        }else{
            $time = $time->format('j F Y H:i');
        }
        $name = $msg->name ?? 'Anonymous';
        SendMessage::dispatch($name, $msg->msg, $time, $msg->color);
    }else{
        return response()->json([
            'success' => false,
        ]);
    }

});
