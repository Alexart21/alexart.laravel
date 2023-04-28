@php
    $siteKey = config('grecaptcha.recaptcha_v3_site_key');
@endphp
<x-layouts.test title="Test confirmated">
    <script src="https://www.google.com/recaptcha/api.js?render=6LftRl0aAAAAAHJDSCKdThCy1TaS9OwaGNPSgWyC"></script>
    <h1>Test Recaptcha</h1>
    <form action="{{ route('test.blastore') }}" method="post" id="bla-form">
        @csrf
        <label for="l">Name : </label><input type="text" name="name" id="l" value="{{ old('name') }}">
        <br>
        @error('name')
        <div style="color:red">
            {{ $message }}
        </div>
        @enderror

        <label for="p">Age : </label><input type="text" name="age" id="p">
        <br>
        @error('age')
        <div style="color:red">
            {{ $message }}
        </div>
        @enderror
        <input type="hidden" id="bla-recaptcha" name="reCaptcha"/>
        @error('reCaptcha')
        <div style="color:red">
            {{ $message }}
        </div>
        @enderror
        <br>
        <button type="submit">SEND</button>
    </form>
</x-layouts.test>
<script>
    let blaform = document.getElementById('bla-form');
    blaform.onsubmit = (e) => {
        e.preventDefault();
        grecaptcha.ready(function () {
            grecaptcha
                .execute("{{ $siteKey }}", {
                    action: "post",
                })
                .then(async function (token) {
                    /* Все дальнейшие операции только после получения reCaptcha токена !!! */
                    let inp = document.getElementById("bla-recaptcha");
                    inp.value = token;
                    blaform.submit();
                })
        });
    }
</script>
