<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Broadcasting\Broadcasters\PusherBroadcaster;
use Illuminate\Http\Request;
use Pusher\Pusher;

class SocketsController
{
    public function connect(Request $request)
    {
        $broadcaster = new PusherBroadcaster(
            new Pusher(
                config('pusher.pusher_app_key'),
                config('pusher.pusher_app_secret'),
                config('pusher.pusher_app_id'),
                []
            )
        );

        return $broadcaster->validAuthenticationResponse($request, []);
    }
}
