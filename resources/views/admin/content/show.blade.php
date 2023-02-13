<x-layouts.admin title="">
    <h1>{{ $page->page }}</h1>
    @include('flash::message')
    <div>
        <a href="{{ route('content.edit', [ $page->id ]) }}" class="btn btn-primary">редактировать</a>
    </div>
    {!! $page->page_text !!}
</x-layouts.admin>
