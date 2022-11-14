@php
    use Jenssegers\Date\Date;

    $h1 = $new ? 'Заказы обратных звонков - новые' : 'Заказы обратных звонков - все';

@endphp
<x-layouts.admin title="Заказы обратных звонков | страница {{ $calls->currentPage() }}">
    <div class="d-flex"><h1>{{ $h1 }}</h1>
        @if($trashed)
            <div class="top-links">
                <a href="{{ route('call.trash') }}" class="btn btn-warning">Корзина</a>
            </div>
        @endif
    </div>
    @if($count)
        <div class="d-flex">
            @if($new)
                <a href="{{ route('call.index') }}" class="btn btn-success top-links">показать все</a>
            @else
                <a href="{{ route('call.index', ['sort' => 'new']) }}" class="btn btn-success top-links">только новые</a>
            @endif
            <form class="top-links" action="{{ route('call.destroyAll', [ 'sort' => $new ? 'new' : 'all', 'page' => $calls->currentPage() ]) }}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-warning">
                    Все в корзину
                </button>
            </form>
            <form class="top-links" action="{{ route('call.deleteAll') }}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">
                    Все удалить безвозвратно
                </button>
            </form>
        </div>
        <div class="font-italic">{{ $count }} записей из {{ $total }}</div>
        <table class="table-bordered table-hover table-admin">
            <tr>
                <th>id</th>
                <th>Имя</th>
                <th>Телефон</th>
                <th>Дата</th>
                <th>Действия</th>
            </tr>
            @foreach($calls as $call)
                <tr class="{{ $call->status ? '' : 'table-success' }}">
                    <td>{{ $call->id }}</td>
                    <td>{{ $call->name }}</td>
                    <td>{{ $call->tel }}</td>
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
                    <td>{{ $date }}</td>
                    <td>
                        <div class="d-flex">
                            <div class="top-links"><a href="{{ route('call.show', [ $call->id ]) }}"><span
                                        class="fa fa-eye"></span></a></div>
                            <div class="top-links">
                                <form action="{{ route('call.destroy', [ $call->id ]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Отправит в корзину ?')">
                                        <span class="fa fa-trash text-danger"></span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <h4>Нет данных</h4>
    @endif
    <br>
    {{ $calls->links('vendor.pagination.bootstrap-4') }}
</x-layouts.admin>
