<x-layouts.test title="Test confirmated">
    <br>
    <br>
    <br>
    @include('flash::message')
    <form action="{{ route('test.confirmStore') }}" method="post">
        @csrf
        <label for="l">Логин : </label><input type="text" name="login" id="l" value="{{ old('login') }}">
        <br>
        @error('login')
        <div style="color:red">
            {{ $message }}
        </div>
        @enderror

        <label for="p">Пароль : </label><input type="text" name="password" id="p">
        <br>
        @error('password')
        <div style="color:red">
            {{ $message }}
        </div>
        @enderror

        <label for="pc">Пароль еще раз : </label><input type="text" name="password_confirmation" id="pc">
        @error('password_confirmation')
        <div style="color:red">
            {{ $message }}
        </div>
        @enderror

        <br>
        <button type="submit">SEND</button>
    </form>
</x-layouts.test>
