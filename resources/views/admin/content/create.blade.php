@php
    // показать или нет CKEditor
    $visual = isset($_GET['mode']) && $_GET['mode'] === 'v' ? true : false;
@endphp
@if($visual)
    <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
@endif
<x-layouts.admin title="Создать страницу">
    {{ Breadcrumbs::render('content_create') }}
    <span class="h2">Создание новой страницы</span>&nbsp;&nbsp;<a class="h3" href="{{ route('content.index') }}">все страницы</a>
    <br>
    @if($visual)
        &nbsp;&nbsp;<span class="h3"><a class="h3" href="{{ route('content.create') }}">Текстовый режим</a></span>
    @else
        &nbsp;&nbsp;<span class="h3">Включить <a class="h3"
                                                 href="{{ route('content.create', ['mode' => 'v']) }}">CKEditor</a></span>
    @endif
    <br>
    <br>
    <form method="post" action="{{ route('content.store') }}">
        @csrf
        <div class="form-group">
            <label for="">Алиас/ссылка [page]:</label>
            <input class="form-control @error('page') is-invalid @enderror" type="text" name="page" value="{{ old('page') }}">
            @error('page')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label for="">Заголовок [title]:</label>
            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{ old('title') }}">
            @error('title')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label for="">Заголовок в тег title [title_seo]:</label>
            <input class="form-control @error('title_seo') is-invalid @enderror" type="text" name="title_seo" value="{{ old('title_seo') }}">
            @error('title_seo')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label for="">В тег description [description]:</label>
            <input class="form-control @error('description') is-invalid @enderror" type="text" name="description" value="{{ old('description') }}">
            @error('description')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label for="">Код страницы [page_text]:</label>
            <textarea class="form-control @error('page_text') is-invalid @enderror" name="page_text" id="summary-ckeditor" cols="30" rows="10">{{ old('page_text') }}</textarea>
            @error('page_text')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <button class="btn btn-success" type="submit">Сохранить</button>
        </div>
    </form>
    @if($visual)
    <script>
        CKEDITOR.replace( 'summary-ckeditor', {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>
    @endif
</x-layouts.admin>
