@php
use Jenssegers\Date\Date;

$h1 = $new ? 'Заказы обратных звонков - новые' : 'Заказы обратных звонков - все';
@endphp
<x-layouts.admin title="Входящие сообщения | страница {{ $mails->currentPage() }}">
    <div class="d-flex">
        <h1>Входящие сообщения</h1>
        @if($trashed)
            <div class="top-links">
                <a href="{{ route('post.trash') }}" class="btn btn-warning">Корзина</a>
            </div>
        @endif
    </div>
    @if($count)
        <div class="d-flex">
            @if($new)
                <a href="{{ route('post.index') }}" class="btn btn-success top-links">показать все</a>
            @else
                <a href="{{ route('post.index', ['s' => 'new']) }}" class="btn btn-success top-links">только новые</a>
            @endif
            <form class="top-links" action="{{ route('post.destroyAll') }}" method="post" >
                @csrf
                @method('DELETE')
                <button class="btn btn-warning">
                    Все в корзину
                </button>
            </form>
            <form class="top-links" action="{{ route('post.deleteAll') }}" method="post" >
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
                <th>Email</th>
                <th>Телефон</th>
                <th>Текст</th>
                <th>Дата</th>
                <th>Действия</th>
            </tr>
            @foreach($mails as $mail)
                <tr class="{{ $mail->status ? '' : 'table-success' }}">
                    <td>{{ $mail->id }}</td>
                    <td>{{ $mail->name }}</td>
                    <td>{{ $mail->email }}</td>
                    <td>{{ $mail->tel ?? 'не указан' }}</td>
                    <td class="body-text">{{ $mail->body }}</td>
                    @php
                        $date = Date::parse($mail->created_at);
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
                            <div class="top-links"><a href="{{ route('post.show', [ $mail->id ]) }}"><span
                                        class="fa fa-eye"></span></a></div>
                            <div class="top-links">
                                <form action="{{ route('post.destroy', [ $mail->id ]) }}" method="post">
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
    @else
    <h4>Нет данных</h4>
    @endif
    <br>
    {{ $mails->links('vendor.pagination.bootstrap-4') }}
</x-layouts.admin>
