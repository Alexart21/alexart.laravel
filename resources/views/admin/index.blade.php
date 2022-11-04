<x-layouts.admin title="Админка">
<h1>Админка</h1>
<ul>
    @foreach($pages as $page)
        <li>
            <a href="{{ route('content.show', [ $page->id ]) }}">{{ $page->page }}</a>
        </li>
    @endforeach
</ul>
</x-layouts.admin>
