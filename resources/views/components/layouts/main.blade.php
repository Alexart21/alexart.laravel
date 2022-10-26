@props([
'data'
])
{{-- При подключении аналитики проверь адреса Content-Security-Policy: script-src --}}
@php
    header('X-Frame-Options: sameorigin');
    header('X-Content-Type-Options: nosniff');
    header('X-XSS-Protection: 1;mode=block');
    header('Content-Security-Policy: default-src \'self\' \'unsafe-inline\' \'unsafe-eval\'; img-src \'self\' data:; style-src \'self\' \'unsafe-inline\'; script-src \'self\' \'unsafe-inline\' *.google.com www.gstatic.com; frame-src *.google.com gstatic.com');
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
{{--    <link rel="manifest" href="{{ asset('browserconfig.xml') }}"/>--}}
    <meta name="msapplication-config" content="{{ asset('browserconfig.xml')  }}"/>
    <!-- <meta name="referrer" content="origin"/> -->
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="HandheldFriendly" content="true">
    <meta name="keywords" content="">
    <meta name="description" content="{{ $data->description }}">
    <link href="{{ asset('assets/a9bedd54/css/bootstrap.css')  }}" rel="stylesheet">
    <link href="{{ asset('css/style.css')  }}" rel="stylesheet">
    <link href="{{ asset('css/animate.min.css')  }}" rel="stylesheet">
    <link href="{{ asset('css/animate.min.css')  }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/all.min.css')  }}" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js?render=6LftRl0aAAAAAHJDSCKdThCy1TaS9OwaGNPSgWyC"></script>
<body>
<x-ui.loader />
<output id="my-modal"></output>
{{-- Модальное обратного звонка --}}
<x-ui.callModal />
{{-- конец Модальное обратного звонка --}}
{{-- Success Modal --}}
<x-ui.successModal />
{{-- конец Success Modal --}}
<div id="container">
{{--  мобильное меню  --}}
<!--noindex-->
    <x-ui.mobMenu />
    <!--/noindex-->
    {{-- конец мобильное меню  --}}
    <div id="main">
        <div id="all">
            <x-main.header />
            <x-main.topMenu />
            <div id="block">
                <!-- начало левый блок -->
                <x-main.leftBlock />
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
            <x-ui.scrollTop />
            <!-- блок мессенджеров -->
            <x-ui.msgBlock />
            <!-- конец блок мессенджеров -->
        </div>
    </div>
    <!--noindex-->
    <div style="width:100%;height:10px"></div>
    <x-main.footer />
    <!--/noindex-->
</div>
<script src="{{ asset('assets/9e6dad0b/jquery.js') }}"></script>
<script src="{{ asset('js/jquery.maskedinput.min.js')  }}"></script>
<script src="{{ asset('assets/a9bedd54/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('js/wow.min.js') }}"></script>
<script src="{{ asset('js/velocity.min.js') }}"></script>
<script src="{{ asset('js/velocity.ui.min.js') }}"></script>
<script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>
