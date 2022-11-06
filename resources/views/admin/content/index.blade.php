<x-layouts.admin title="Админка">
    <div class="d-flex">
        <h1>Основные страницы</h1>
        <div>
            &nbsp;&nbsp;&nbsp;
            <a href="{{ route('content.create') }}" class="btn btn-info">Создать</a>
        </div>
        @if($trashed)
            <div>
                &nbsp;&nbsp;&nbsp;
                <a href="{{ route('content.trash') }}" class="btn btn-warning">Корзина</a>
            </div>
        @endif
    </div>
    <table class="table-bordered table-hover table-admin">
        <tr>
            <th>id</th>
            <th>page</th>
            <th>title</th>
            <th>действия</th>
        </tr>
        @foreach($pages as $page)
            <tr>
                <td>{{ $page->id }}</td>
                <td>{{ $page->page }}</td>
                <td>{{ $page->title }}</td>
                <td>
                    <div class="d-flex">
                        <div class="top-links"><a href="{{ route('content.show', [ $page->id ]) }}"><span
                                    class="fa fa-eye"></span></a></div>
                        <div class="top-links"><a href="{{ route('content.edit', [ $page->id ]) }}"><span
                                    class="fa fa-pen"></span></a></div>
                        <div class="top-links">
                            <form action="{{ route('content.destroy', [ $page->id ]) }}" method="post">
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
