<x-layouts.admin title="">
<h1>{{ $page->page }}</h1>
@include('flash::message')
<a href="{{ route('content.edit', [ $page->id ]) }}">edit</a>
{!! $page->page_text !!}
</x-layouts.admin>
