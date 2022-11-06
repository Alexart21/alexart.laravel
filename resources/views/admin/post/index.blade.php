<x-layouts.admin title="Входящие сообщения">
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
                <tr>
                    <td>{{ $mail->id }}</td>
                    <td>{{ $mail->name }}</td>
                    <td>{{ $mail->email }}</td>
                    <td>{{ $mail->tel ?? 'не указан' }}</td>
                    <td class="body-text">{{ $mail->body }}</td>
                    <td>{{ $mail->updated_at }}</td>
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
