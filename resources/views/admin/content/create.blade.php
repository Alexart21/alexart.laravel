<x-layouts.admin title="Создать страницу">
    <h1>Создать страницу</h1>
    <form method="post" action="{{ route('content.store') }}">
        @csrf
        <div class="form-group">
            <label for="">Алиас/ссылка [page]:</label>
            <input class="form-control" type="text" name="page" value="{{ old('page') }}">
            @error('page')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label for="">Заголовок [title]:</label>
            <input class="form-control" type="text" name="title" value="{{ old('title') }}">
            @error('title')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label for="">Заголовок в тег title [title_seo]:</label>
            <input class="form-control" type="text" name="title_seo" value="{{ old('title_seo') }}">
            @error('title_seo')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label for="">В тег description [description]:</label>
            <input class="form-control" type="text" name="description" value="{{ old('description') }}">
            @error('description')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label for="">Код страницы [page_text]:</label>
            <textarea class="form-control" name="page_text" id="" cols="30" rows="10">{{ old('page_text') }}</textarea>
            @error('page_text')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <button class="btn btn-success" type="submit">Сохранить</button>
        </div>
    </form>
</x-layouts.admin>
