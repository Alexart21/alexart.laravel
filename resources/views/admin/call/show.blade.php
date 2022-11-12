@php
    use Jenssegers\Date\Date;
@endphp
<x-layouts.admin title="">
    <div><b>Имя: </b>
        <span>{{ $call->name }}</span>
    </div>
    @if($call->tel)
        <div>
            <b>Тел.: </b>
            <span>{{ $call->tel }}</span>
        </div>
    @endif
    <div>
        <b>Дата: </b>
        @php
            $date = Date::parse($call->created_at);
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
    <form action="{{ route('call.destroy', [ $call->id ]) }}" method="post">
        @csrf
        @method('DELETE')
        <button class="btn btn-warning">Удалить</button>
    </form>
</x-layouts.admin>
