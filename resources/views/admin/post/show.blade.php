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
        <span>{{ $mail->updated_at }}</span>
    </div>
    <form action="{{ route('post.destroy', [ $mail->id ]) }}" method="post">
        @csrf
        @method('DELETE')
        <button class="btn btn-warning">Удалить</button>
    </form>
</x-layouts.admin>
