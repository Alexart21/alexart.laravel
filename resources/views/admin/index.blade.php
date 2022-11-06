<x-layouts.admin title="Админка">
    <h1>Админка</h1>
    @include('flash::message')
    <div class="d-flex">
        <div class="btn top-links" style="color: #fff !important;">
            <a class="" href="{{ route('content.index') }}">Основные страницы</a>
        </div>
        <div class="btn top-links" style="color: #fff !important;">
            <a class="" href="{{ route('post.index') }}">Сообщения</a>
        </div>
        <div class="btn top-links" style="color: #fff !important;">
            <a class="" href="{{ route('call.index') }}">Заказы обратных звонков</a>
        </div>
        <form class="top-links" action="{{ route('admin.cache') }}" method="post">
            @csrf
            <button class="btn btn-warning">
                очистить кэш
            </button>
        </form>
        <form class="top-links" action="{{ route('admin.last') }}" method="post">
            @csrf
            <button class="btn btn-info">
                обновить Last-Modified
            </button>
        </form>
    </div>
</x-layouts.admin>
