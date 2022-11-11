@props([
'title'
])
@php
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Auth;
     // Впихнул в UNION
    $results = DB::select(
    'SELECT COUNT(*) FROM `calls`
    UNION ALL SELECT COUNT(*) FROM `calls` WHERE is_read = 0
    UNION ALL SELECT COUNT(*) FROM `posts`
    UNION ALL SELECT COUNT(*) FROM `posts` WHERE is_read = 0
    ');
    // значения доставать из Std класса таким черезж способом
    foreach ($results as $res) {
        foreach ($res as $item) {
            $x[] = $item;
        }
    }
    // без Union 4 запроса
     /*$msgs => [
    'allCalls' => Call::count(),
    'newCalls' => Call::where('is_read', 0)->count(),
    'allPosts' => Post::count(),
    'newPosts' => Post::where('is_read', 0)->count(),
    ],*/
     $msgs = [
       'allCalls' => $x[0],
        'newCalls' => $x[1],
        'allPosts' => $x[2],
        'newPosts' => $x[3],
    ];
     $user = Auth::user();
    if($user){
        if($user->profile_photo_path){
           $avatar = '/storage/' . $user->profile_photo_path;
        }elseif ($user->avatar){
            $avatar = $user->avatar;
        }else{
           $avatar = '/upload/default_avatar/no-image.png';
        }
    }
@endphp
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <link rel="canonical" href="https://alexart.s-solo.ru"/>
    <link rel="icon" type="image/png" href="{{ asset('icons/512x512.png')  }}"/>
{{--    <link rel="manifest" href="{{ asset('browserconfig.xml') }}"/>--}}
<!-- <meta name="referrer" content="origin"/> -->
    <meta name="viewport" content="width=device-width,initial-scale=1">
    {{--<link href="{{ asset('assets/a9bedd54/css/bootstrap.css')  }}" rel="stylesheet">
    <link href="{{ asset('css/admin_style.css')  }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/all.min.css')  }}" rel="stylesheet">--}}
    @vite([
    'resources/css/bootstrap.min.css',
    {{--    'resources/css/style.css',--}}
    'resources/css/fontawesome/css/all.min.css',
    ])
    <link href="{{ asset('css/style.css')  }}" rel="stylesheet">
    <link href="{{ asset('css/admin_style.css')  }}" rel="stylesheet">
<body>
<div class="admin_header container">
    <div class="msgs-block d-flex">
        <div>
            <a href="{{ route('call.index') }}"><i class="fa fa-phone text-success"></i>
                @if($msgs['newCalls'])
                    <a href="{{ route('call.index') }}"><b>{{ $msgs['newCalls'] }}</b></a>
                @endif
            </a>
        </div>
        &nbsp;&nbsp;&nbsp;
        <div>
            <a href="{{ route('post.index') }}"><i class="fa fa-envelope text-success"></i>
                @if($msgs['newPosts'])
                    <a href="{{ route('post.index') }}"><b>{{ $msgs['newPosts'] }}</b></a>
                @endif
            </a>
        </div>
    </div>
    <div class="d-flex menu-block">
        <div><a href="/">на сайт</a></div>
        <div><a href="{{ route('admin.index') }}">главная</a></div>
        &nbsp;&nbsp;
        <div class="d-flex justify-content-center admin-user-block">
            &nbsp;
            <div><a href="/user/profile" title="личный кабинет">
                    <img src="{{ $avatar }}" alt="" class="avatar rounded-circle img-thumbnail">
                </a>
            </div>
            &nbsp;&nbsp;<div class="username"><a href="/user/profile" title="личный кабинет"
                                                 class="text-dark">{{ $user->name }}</a></div>
            &nbsp;&nbsp;
            {{-- Окошко подтверждения выхода --}}
            <x-ui.dialog />
            {{-- кнопка выход методом POST --}}
            <x-ui.logout-link />
        </div>
    </div>

</div>
<div class="container">
    {{ $slot }}
</div>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.maskedinput.min.js')  }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/admin_scripts.js') }}"></script>
</body>
</html>

