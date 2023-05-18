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
//    'resources/css/animate.min.css',
    'resources/css/style.css',
    ])
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
{{--                <x-main.leftBlock/>--}}
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
{{--            <x-ui.msgBlock/>--}}
        </div>
    </div>
    <!--noindex-->
    <div style="width:100%;height:10px"></div>
    <x-main.footer/>
    <!--/noindex-->
</div>
@vite([
'resources/js/app.js',
])
<script defer src="{{ asset('js/jquery.min.js') }}"></script>
<script defer src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script defer src="{{ asset('js/jquery.maskedinput.min.js')  }}"></script>
<script defer src="{{ asset('js/scripts.js') }}"></script>
<link id="anim-css" rel="stylesheet" media="print" href="{{ asset('css/animate.min.css') }}">
{{-- Отложенная загрузка скриптов и css --}}
<script>
    function loadScript(src, async = true,  callback) {
        let script = document.createElement('script');
        script.src = src;
        script.async = async;
        document.body.appendChild(script);
        if (callback){
            script.onload = ()=> {
                callback();
            }
        }
    }
    let event_status = false; // Статус события (ещё не произошло)
    window.addEventListener("load", function() {
        ["mouseover", "click", "scroll"].forEach(function(event) {
            window.addEventListener(event, function() {
                // start
                if(!event_status) {
                    console.log("отложенная загрузка js css");
                    loadScript('/js/wow.min.js', true, ()=>{(function ($) {
                        new WOW().init();
                    })(jQuery);});
                    loadScript('/js/velocity.min.js', false);
                    loadScript('/js/velocity.ui.min.js', false);
                    loadScript('/js/jquery.toaster.js');
                    //css
                    document.getElementById('anim-css').media = 'all';
                    //recapTcha
                    loadScript("https://www.google.com/recaptcha/api.js?render=6LftRl0aAAAAAHJDSCKdThCy1TaS9OwaGNPSgWyC");
                    // Telegram chat
                    if (!('ontouchstart' in window || navigator.maxTouchPoints)) { // для десктопов
                        console.log('desktop');
                        setTimeout(() => {
                            window.replainSettings = {
                                id: '7a62a2d7-0ab8-4734-a7be-954f867b1e2a',
                                onClientOpenedChat: () => {
                                    // клиент открыл чат или открылся по таймеру
                                    // куку на 1 час
                                    // в течении часа не будет всплывашек
                                    document.cookie = 'chat_open=1;max-age=3600';
                                },
                            };
                            (function(u){var s=document.createElement('script');s.async=true;s.src=u;
                                var x=document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);
                                s.onload = () => {
                                    setTimeout(() => {
                                        if(!readCookie('chat_open')){
                                            window.ReplainAPI('open');
                                            // установить стартовое сообщение (Перебивает то что было в настройках)
                                            // window.ReplainAPI('setStartMessage', 'Привет!!! 👋');
                                            // звук
                                            beep();
                                        }
                                    }, 3000)
                                }
                            })('https://widget.replain.cc/dist/client.js');
                            //

                        }, 3000);
                    }else { // для мобил просто кнопка с ссылкой
                        console.log('mobile');
                        document.getElementById('tg-btn-outher').style.display = 'block';
                    }
                    // Ya Metrica
                    setTimeout(() => {
                        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
                            m[i].l=1*new Date();
                            for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
                            k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
                        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
                        ym(93590799, "init", {
                            clickmap:true,
                            trackLinks:true,
                            accurateTrackBounce:true
                        });
                    }, 4000)
                    event_status = true; // Статус события (произошло)
                }
            }, {
                once: true
            });
            //end
        });
    });
</script>
{{-- конец Отложенная загрузка скриптов и css --}}
</body>
</html>
