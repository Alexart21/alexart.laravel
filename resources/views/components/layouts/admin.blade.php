@props([
'title'
])
@php
    $msgs = session('msgs');
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
    <link href="{{ asset('css/style.css')  }}" rel="stylesheet">
    <link href="{{ asset('css/admin_style.css')  }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/all.min.css')  }}" rel="stylesheet">--}}
    @vite([
    'resources/css/bootstrap.min.css',
    'resources/css/style.css',
    'resources/css/fontawesome/css/all.min.css',
    ])
    <link href="{{ asset('css/admin_style.css')  }}" rel="stylesheet">
<body>
<div class="admin_header container">
    <div class="msgs-block">
        <a href="{{ route('call.index') }}"><i class="fa fa-phone text-success"></i></a>
        @if($msgs['newCalls'])
            <a href="{{ route('call.index') }}"><b>{{ $msgs['newCalls'] }}</b></a>
        @endif
        &nbsp;&nbsp;&nbsp;
        <a href="{{ route('post.index') }}"><i class="fa fa-envelope text-success"></i></a>
        @if($msgs['newPosts'])
            <a href="{{ route('post.index') }}"><b>{{ $msgs['newPosts'] }}</b></a>
        @endif
    </div>
    <div class="d-flex menu-block">
        <div><a href="/">на сайт</a></div>
        <div><a href="{{ route('admin.index') }}">главная</a></div>
    </div>

</div>
<div class="container">
    {{ $slot }}
</div>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.maskedinput.min.js')  }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>

