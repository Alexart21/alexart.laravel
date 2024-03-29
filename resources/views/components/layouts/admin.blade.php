@props([
'title'
])
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" id="_csrf_token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <link rel="icon" type="image/png" href="{{ asset('icons/512x512.png')  }}"/>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    @vite([
    'resources/css/bootstrap.min.css',
    'resources/css/fontawesome/css/all.min.css',
    ])
    <link href="{{ asset('css/style.css')  }}" rel="stylesheet">
    <link href="{{ asset('css/admin_style.css')  }}" rel="stylesheet">
<body>
<div class="adm-flex">
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
                                                 class="text-dark">{{ $username }}
                    {{-- статус $role расшарен в шлюзах в файле app/Providers/AuthServiceProvider.php --}}
                    [{{ $role }}]
                </a></div>
            &nbsp;&nbsp;
            {{-- Окошко подтверждения выхода --}}
            <x-ui.dialog />
            {{-- кнопка выход методом POST --}}
            <x-ui.logout-link />
        </div>
    </div>

</div>

<div class="container admin-main">
    {{ $slot }}
</div>
    <div class="admin-footer container">
        <a href="{{ route('admin.phpinfo') }}">PHPINFO</a>
    </div>
</div>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.maskedinput.min.js')  }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/admin_scripts.js') }}"></script>
</body>
</html>

