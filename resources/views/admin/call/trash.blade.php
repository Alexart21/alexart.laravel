@php
    use Jenssegers\Date\Date;
@endphp
<x-layouts.admin title="Админка">
    {{ Breadcrumbs::render('calls_trashed') }}
    <h1>Корзина</h1>
    <div>
        <form action="{{ route('call.clear') }}" method="post" >
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">
                Очистить
            </button>
        </form>
    </div>
    <table class="table-bordered table-hover table-admin">
        <tr>
            <th>id</th>
            <th>Имя</th>
            <th>Телефон</th>
            <th>Дата удаления</th>
            <th>Действия</th>
        </tr>
        @foreach($calls as $call)
            <tr>
                <td>{{$call->id }}</td>
                <td>{{ $call->name }}</td>
                <td>{{ $call->tel ?? 'не указан' }}</td>
                @php
                    $date = Date::parse($call->deleted_at);
                if($date->isYesterday()){
                    $date = 'вчера в ' . $date->format('H:i');
                }elseif ($date->isToday()){
                    $date = 'сегодня в ' . $date->format('H:i');
                }else{
                    $date = $date->format('j F Y H:i');
                }
                @endphp
                <td>{{ $date }}</td>
                <td>
                    <div class="d-flex">
                        <div>
                            <form class="top-links" action="{{ route('call.restore', [ $call->id ]) }}" method="post">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-info">
                                    восстановить
                                </button>
                            </form>
                        </div>
                        <div>
                            <form class="top-links del-form" action="{{ route('call.remove', [ $call->id ]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">
                                    удалить безвозвратно
                                </button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
            </tr>
        @endforeach
    </table>
</x-layouts.admin>

