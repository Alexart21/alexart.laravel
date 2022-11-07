@php
    use Jenssegers\Date\Date;
@endphp
<x-layouts.admin title="">
    <div><b>Имя: </b>
        <span>{{ $mail->name }}</span>
    </div>
    <div>
        <b>Email: </b>
        <span>{{ $mail->email }}</span>
    </div>
    @if($mail->tel)
        <div>
            <b>Тел.: </b>
            <span>{{ $mail->tel }}</span>
        </div>
    @endif
    <div>
        <b>Текст сообщения: </b>
        <span>{{ $mail->body }}</span>
    </div>
    <div>
        <b>Дата: </b>
        @php
            $date = Date::parse($mail->updated_at);
        if($date->isYesterday()){
            $date = 'вчера в ' . $date->format('H:i');
        }elseif ($date->isToday()){
            $date = 'сегодня в ' . $date->format('H:i');
        }else{
            $date = $date->format('j F Y H:i');
        }
        @endphp
        <span>{{ $date }}</span>
    </div>
    <form action="{{ route('post.destroy', [ $mail->id ]) }}" method="post">
        @csrf
        @method('DELETE')
        <button class="btn btn-warning">Удалить</button>
    </form>
</x-layouts.admin>
