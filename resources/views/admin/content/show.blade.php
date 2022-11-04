<h1>{{ $page->page }}</h1>
<a href="{{ route('content.edit', [ $page->id ]) }}">edit</a>
{!! $page->page_text !!}
