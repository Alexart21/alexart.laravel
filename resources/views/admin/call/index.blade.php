<x-layouts.admin title="Заказы обратных звонков">
    <div class="d-flex">
        <h1>Заказы обратных звонков</h1>
        @if($trashed)
            <div>
                <a href="{{ route('call.trash') }}" class="btn btn-warning">Корзина</a>
            </div>
        @endif
    </div>
    <table class="table-bordered table-hover">
        <tr>
            <th>id</th>
            <th>Имя</th>
            <th>Телефон</th>
            <th>Дата</th>
            <th>Действия</th>
        </tr>
        @foreach($calls as $call)
            <tr>
                <td>{{ $call->id }}</td>
                <td>{{ $call->name }}</td>
                <td>{{ $call->tel }}</td>
                <td>{{ $call->updated_at }}</td>
                <td>
                    <div class="d-flex">
                        <div class="top-links"><a href="{{ route('call.show', [ $call->id ]) }}"><span
                                    class="fa fa-eye"></span></a></div>
                        <div class="top-links">
                            <form action="{{ route('call.destroy', [ $call->id ]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button>
                                    <span class="fa fa-trash text-danger"></span>
                                </button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
</x-layouts.admin>
