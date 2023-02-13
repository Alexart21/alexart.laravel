<x-layouts.admin title="">
    <span class="h3">Страница {{ $page->page }}</span>&nbsp;&nbsp;
    <a class="h3" href="{{ route('content.index') }}">все страницы</a>
    <br>
    @include('flash::message')
    <div>
        <a href="{{ route('content.edit', [ $page->id ]) }}" class="btn btn-primary">редактировать</a>
    </div>
    {!! $page->page_text !!}
</x-layouts.admin>
