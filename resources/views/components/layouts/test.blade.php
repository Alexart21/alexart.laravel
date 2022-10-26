@props([
'title'
])
{{-- При подключении аналитики проверь адреса Content-Security-Policy: script-src --}}
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <link rel="icon" type="image/png" href="{{ asset('icons/512x512.png')  }}"/>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="HandheldFriendly" content="true">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link href="{{ asset('assets/a9bedd54/css/bootstrap.css')  }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/all.min.css')  }}" rel="stylesheet">
<body>
<!-- начало основной контент -->
<div class="inc-out">
    <main id="inc" class="container">
        {{ $slot }}
    </main>
</div>
<!-- конец основной контент -->
{{--<script src="{{ asset('assets/a9bedd54/js/bootstrap.bundle.js') }}"></script>--}}
</body>
</html>
