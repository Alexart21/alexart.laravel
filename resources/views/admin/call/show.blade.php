@php
    use Jenssegers\Date\Date;
@endphp
<x-layouts.admin title="">
    {{ Breadcrumbs::render('call', $call) }}
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
    <form style="display: inline-block" action="{{ route('call.destroy', [ $call->id ]) }}" method="post">
        @csrf
        @method('DELETE')
        <button class="btn btn-warning">В корзину</button>
    </form>
    <form class="del-form" style="display: inline-block" action="{{ route('call.remove', [ $call->id ]) }}" method="post">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger">
            Удалить безвозвратно
        </button>
    </form>
</x-layouts.admin>
