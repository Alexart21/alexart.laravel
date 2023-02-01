<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Конструктор чехлов для телефона</title>
    <link rel="icon" type="image/png" href="{{ asset('icons/512x512.png')  }}"/>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="HandheldFriendly" content="true">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link href="{{ asset('vue_assets/css/app.css')  }}" rel="stylesheet">
<body>
<!-- начало основной контент -->
    <main>
        {{ $slot }}
    </main>
<!-- конец основной контент -->
<script src="{{ asset('vue_assets/js/chunk-vendors.js') }}"></script>
<script src="{{ asset('vue_assets/js/app.js') }}"></script>
</body>
</html>
