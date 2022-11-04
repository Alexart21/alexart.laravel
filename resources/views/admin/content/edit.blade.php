<x-layouts.admin title="Админка">
<h1>{{ $page->page }}</h1>
<form method="post" action="{{ route('content.update', [ $page->id ]) }}">
    @csrf
    @method('PUT')
    <div>ID: {{ $page->id }}</div>
    <div class="form-group">
        <input type="text" name="page" value="{{$page->page }}">
    </div>
    <div class="form-group">
        <input type="text" name="title" value="{{ $page->title }}">
    </div>
    <div class="form-group">
        <input type="text" name="title_seo" value="{{ $page->title_seo }}">
    </div>
    <div class="form-group">
        <input type="text" name="description" value="{{ $page->description }}">
    </div>
    <div class="form-group">
        <textarea name="page_text" id="" cols="30" rows="10">{{ $page->page_text }}</textarea>
    </div>
    <div class="form-group">
        <button type="submit">SEND</button>
    </div>
</form>
</x-layouts.admin>
