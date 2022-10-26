<x-layouts.test title="Test form">
    <h1>TEST</h1>
    <form method="post" action="{{ route('test.store') }}">
        @csrf
        Имя--: <input type="text" name="name" value="{{ old('name') }}" /><br>
        @error('name')<div class="text-danger">{{ $message }}</div>@enderror
        Email.--: <input type="text" name="email" value="{{ old('email') }}" /><br>
        @error('email')<div class="text-danger">{{ $message }}</div>@enderror
        Тел.--: <input type="text" name="phone" value="{{ old('phone') }}" /><br>
        @error('phone')<div class="text-danger">{{ $message }}</div>@enderror
        Текст.: <textarea name="body">{{ old('body') }}</textarea><br>
        @error('body')<div class="text-danger">{{ $message }}</div>@enderror
        <button>Send</button>
    </form>
</x-layouts.test>
