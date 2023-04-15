@php
    use Jenssegers\Date\Date;
@endphp
<x-layouts.admin title="Основные страницы | страница {{ $pages->currentPage() }}">
    {{ Breadcrumbs::render('contents') }}
    <br>
    <div class="d-flex">
        <h1>Основные страницы</h1>&nbsp;
        <div>
            <a href="{{ route('content.create') }}" class="btn btn-info">Создать</a>
        </div>
        @if($trashed)
            <div>
                &nbsp;&nbsp;&nbsp;
                <a href="{{ route('content.trash') }}" class="btn btn-warning">Корзина</a>
            </div>
        @endif
    </div>
    @if($count)
    <table class="table-bordered table-hover table-admin">
        <tr>
            <th>id</th>
            <th>page</th>
            <th>title</th>
            <th>дата изменения</th>
            <th>действия</th>
        </tr>
        @foreach($pages as $page)
            <tr>
                <td>{{ $page->id }}</td>
                <td>{{ $page->page }}</td>
                <td>{{ $page->title }}</td>
                @php
                    $date = Date::parse($page->updated_at);
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
                        <div class="top-links"><a href="{{ route('content.show', [ $page->id ]) }}"><span
                                    class="fa fa-eye"></span></a></div>
                        <div class="top-links"><a href="{{ route('content.edit', [ $page->id ]) }}"><span
                                    class="fa fa-pen"></span></a></div>
                        <div class="top-links">
                            <form class="delForms" action="{{ route('content.destroy', [ $page->id ]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="delBtns">
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
    {{ $pages->links('vendor.pagination.bootstrap-4') }}
</x-layouts.admin>
