@php
    use Jenssegers\Date\Date;
@endphp
<x-layouts.admin title="Админка">
    <h1>Корзина</h1>
    <div>
        <form action="{{ route('post.clear') }}" method="post" >
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
            <th>Email</th>
            <th>Телефон</th>
            <th>Текст</th>
            <th>Дата удаления</th>
            <th>Действия</th>
        </tr>
        @foreach($mails as $mail)
            <tr>
                <td>{{$mail->id }}</td>
                <td>{{ $mail->name }}</td>
                <td>{{ $mail->email }}</td>
                <td>{{ $mail->tel ?? 'не указан' }}</td>
                <td>{{ $mail->body }}</td>
                @php
                    $date = Date::parse($mail->deleted_at);
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
                            <form class="top-links" action="{{ route('post.restore', [ $mail->id ]) }}" method="post">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-info">
                                    восстановить
                                </button>
                            </form>
                        </div>
                        <div>
                            <form class="top-links" action="{{ route('post.remove', [ $mail->id ]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">
                                    удалить навсегда
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

