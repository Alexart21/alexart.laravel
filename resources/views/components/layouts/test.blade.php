@props([
'title'
])
{{-- При подключении аналитики проверь адреса Content-Security-Policy: script-src --}}
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <meta name="csrf-token" id="_csrf_token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('icons/512x512.png')  }}"/>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="HandheldFriendly" content="true">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link href="{{ asset('css/bootstrap5.min.css')  }}" rel="stylesheet">
    <link href="{{ asset('css/datalist.css')  }}" rel="stylesheet">
<body>
<!-- начало основной контент -->
<div class="inc-out">
    <main id="inc" class="container">
        {{ $slot }}
    </main>
</div>
<!-- конец основной контент -->
<script src="{{ asset('js/jquery3.6.0.min.js') }}"></script>
<script src="{{ asset('js/datalist.js') }}"></script>
<script src="{{ asset('js/bootstrap5.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script>
    // Telegramm
    /*window.replainSettings = { id: '7a62a2d7-0ab8-4734-a7be-954f867b1e2a' };
    (function(u){var s=document.createElement('script');s.async=true;s.src=u;
        var x=document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);
    })('https://widget.replain.cc/dist/client.js');*/
    // watsapp
        window.replainSettings = { id: '2aa90b4a-ffde-496c-8086-b92ccf3fe949' };
        (function(u){var s=document.createElement('script');s.async=true;s.src=u;
        var x=document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);
    })('https://widget.replain.cc/dist/client.js');
</script>
</body>
</html>
