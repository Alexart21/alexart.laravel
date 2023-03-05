@props([
'data'
])
{{-- При подключении аналитики проверь адреса Content-Security-Policy: script-src --}}
@php
    header('X-Frame-Options: sameorigin');
    header('X-Content-Type-Options: nosniff');
    header('X-XSS-Protection: 1;mode=block');
    //header('Content-Security-Policy: default-src \'self\' \'unsafe-inline\' \'unsafe-eval\'; img-src \'self\' data:; style-src \'self\' \'unsafe-inline\'; script-src \'self\' \'unsafe-inline\' *.google.com www.gstatic.com; frame-src *.google.com gstatic.com');
    header('Permissions-Policy: camera=(), display-capture=(), geolocation=(), microphone=()');
    header('Referrer-Policy: origin-when-cross-origin');
    header('Strict-Transport-Security: max-age=31536000');

    $title = $data->title_seo ?? $data->title;
@endphp
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <link rel="canonical" href="https://alexart.s-solo.ru"/>
    <link rel="icon" type="image/png" href="{{ asset('icons/512x512.png')  }}"/>
    <meta name="csrf-token" id="_csrf_token" content="{{ csrf_token() }}">
    <meta name="msapplication-config" content="{{ asset('browserconfig.xml')  }}"/>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="HandheldFriendly" content="true">
    <meta name="keywords" content="">
    <meta name="description" content="{{ $data->description }}">
    @vite([
    'resources/css/app.css',
    'resources/css/bootstrap.min.css',
    'resources/css/animate.min.css',
    'resources/css/style.css',
    ])
    <script src="https://www.google.com/recaptcha/api.js?render=6LftRl0aAAAAAHJDSCKdThCy1TaS9OwaGNPSgWyC"></script>
<body>
@auth()
    @if(!auth()->user()->email_verified_at)
        <div class="alert alert-danger">
            <h2>Подтвердите регистрацию через email {{ auth()->user()->email }}</h2>
        </div>
    @endif
@endif
<x-ui.loader/>
<output id="my-modal"></output>
{{-- Модальное обратного звонка --}}
<x-ui.callModal/>
{{-- конец Модальное обратного звонка --}}
{{-- Success Modal --}}
<x-ui.successModal/>
{{-- конец Success Modal --}}
<div id="container">
{{--  мобильное меню  --}}
<!--noindex-->
    <x-ui.mobMenu/>
    <!--/noindex-->
    {{-- конец мобильное меню  --}}
    <div id="main">
        <div id="all">
            <x-main.header/>
            <x-main.topMenu/>
            <div id="block">
                <!-- начало левый блок -->
                <x-main.leftBlock/>
                <!-- конец левый блок -->
                <!-- начало основной контент -->
                <div class="inc-out">
                    <main id="inc">
                        {{ $slot }}
                    </main>
                    <div id="inc-overlay"></div>
                </div>
                <!-- конец основной контент -->
            </div>
            <!--кнопка вверх-->
            <x-ui.scrollTop/>
            <!-- блок мессенджеров -->
            <x-ui.msgBlock/>
            <!-- конец блок мессенджеров -->
        </div>
    </div>
    <!--noindex-->
    <div style="width:100%;height:10px"></div>
    <x-main.footer/>
    <!--/noindex-->
</div>
@vite([
'resources/js/app.js',
'resources/js/velocity.min.js',
'resources/js/velocity.ui.min.js',
'resources/js/wow.min.js',
])
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.maskedinput.min.js')  }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>
