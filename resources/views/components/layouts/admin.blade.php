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
    <link href="{{ asset('assets/a9bedd54/css/bootstrap.css')  }}" rel="stylesheet">
    <link href="{{ asset('css/style.css')  }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/all.min.css')  }}" rel="stylesheet">
<body>

<main id="inc">
    {{ $slot }}
</main>

<script src="{{ asset('assets/9e6dad0b/jquery.js') }}"></script>
<script src="{{ asset('js/jquery.maskedinput.min.js')  }}"></script>
<script src="{{ asset('assets/a9bedd54/js/bootstrap.bundle.js') }}"></script>
</body>
</html>

