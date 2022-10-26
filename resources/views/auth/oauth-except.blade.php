<h3>Вы уже исрользовали email <b>{{ $email }} </b> когда регистрировались через <b>{{ $oauth_client }} </b></h3>.
<br>
<h3>Вы можете:</h3>
<ol>
    <li>Снова войти с помощью <b>{{ $oauth_client }}</b> (рекомендуется!)</li>
    <li>Войти через другой сервис где у Вас в профиле email отличный от <b>{{ $email }} </b></li>
    <li><a href="/register">Зарегистрироваться</a> обычным способом указав email отличный от <b>{{ $email }}</b></li>
    <li> Отменить предидущую авторизацию через <b>{{ $oauth_client }}</b> и войти заново любым доступным способом.
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
