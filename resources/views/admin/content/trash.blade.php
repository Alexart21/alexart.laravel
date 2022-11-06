<x-layouts.admin title="Админка">
    <h1>Корзина</h1>
    <table class="table-bordered table-hover">
        <tr>
            <th>id</th>
            <th>page</th>
            <th>title</th>
            <th>удалено</th>
            <th>действия</th>
        </tr>
        @foreach($pages as $page)
            <tr>
                <td>{{$page->id }}</td>
                <td>{{ $page->page }}</td>
                <td>{{ $page->title }}</td>
                <td>{{ $page->deleted_at }}</td>
                <td>
                    <div class="d-flex">
                        <div>
                            <form class="top-links" action="{{ route('content.restore', [ $page->id ]) }}" method="post">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-info">
                                    восстановить
                                </button>
                            </form>
                        </div>
                        <div>
                            <form class="top-links" action="{{ route('content.remove', [ $page->id ]) }}" method="post">
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

