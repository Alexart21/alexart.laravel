<div style="font-size: 150%">Вы уже использовали email <b style="color:blue">{{ $email }} </b> когда авторизовались через <b style="color:blue">{{ $service }} </b></div>.
<br>
<h3>Вы можете:</h3>
<ol>
    <li>Снова войти с помощью <b>{{ $service }}</b> (рекомендуется!)</li>
    <li>Войти через другой сервис где у Вас в профиле email отличный от <b>{{ $email }} </b></li>
    <li><a href="/register">Зарегистрироваться</a> обычным способом указав email отличный от <b>{{ $email }}</b></li>
    <li> Отменить предидущую авторизацию через <b>{{ $service }}</b> и войти заново любым доступным способом.
        <form method="post" action="{{ route('oauth.destroy', [$id]) }}" style="display: inline-block">
            @csrf
            @method('DELETE')
            <button style="background: red;color: #fff;padding: .5em;border: 1px solid #000;border-radius: 4px;margin-left: 1em;cursor: pointer">Отменить</button>
        </form>
    </li>
</ol>
<br>
<h3>Войти с помощью:</h3>
@include('auth.oauth-icons')
