<script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
<x-layouts.admin title="Админка">
    <h1>Страница {{ $page->page }}</h1>
    <form method="post" action="{{ route('content.update', [ $page->id ]) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="">Алиас [page]:</label>
            <input class="form-control" type="text" name="page" value="{{$page->page }}">
            @error('page')
            <div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label for="">Заголовок [title]:</label>
            <input class="form-control" type="text" name="title" value="{{ $page->title }}">
            @error('title')
            <div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label for="">Заголовок в тег title [title_seo]:</label>
            <input class="form-control" type="text" name="title_seo" value="{{ $page->title_seo }}">
            @error('title_seo')
            <div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label for="">В тег description [description]:</label>
            <input class="form-control" type="text" name="description" value="{{ $page->description }}">
            @error('description')
            <div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label for="">Код страницы [page_text]:</label>
            <textarea class="form-control" name="page_text" id="summary-ckeditor">{{ $page->page_text }}</textarea>
            @error('page_text')
            <div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <button class="btn btn-success" type="submit">Сохранить</button>
        </div>
    </form>
    <script>
        CKEDITOR.replace( 'summary-ckeditor', {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>
</x-layouts.admin>
