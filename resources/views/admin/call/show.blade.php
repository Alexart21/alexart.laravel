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
        <span>{{ $call->updated_at }}</span>
    </div>
    <form action="{{ route('call.destroy', [ $call->id ]) }}" method="post">
        @csrf
        @method('DELETE')
        <button class="btn btn-warning">Удалить</button>
    </form>
</x-layouts.admin>
