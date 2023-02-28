<x-layouts.test title="Test form">
<video width="400" height="300" controls="controls">
     <source src="{{ route('test.video') }}" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' poster="{{ asset('img/msg.png') }}">
</video>
</x-layouts.test>
