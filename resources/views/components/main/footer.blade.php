@php
$Year = date('Y');
@endphp
<footer class="innerShadow gradient3">
    <strong class="company">Alex-art21</strong><sup>&copy;</sup> web developer group 2009&mdash;{{ $Year }} тел. <b
        class="corpid">+7(987) 668-04-84</b><br/>
    <strong>Создание и продвижение сайтов в Чебоксарах</strong><br/>
    <span>Ваши персональные данные могут обрабатывается только в соответствии с
                        <a href="/politic"
                           style="position: relative;z-index: 100">ФЗ «О персональных данных» № 152-ФЗ</a></span>
    <br><small style="position: relative;z-index: 100">Этот сайт защищен Google reCAPTCHA в соответствии с
        <a href="https://policies.google.com/privacy">политикой конфиденциальности</a> и
        <a href="https://policies.google.com/terms">условиями применения</a>.
    </small>
    <br>
    <div class="d-flex justify-content-center user-block">
        <div>
            <div class="no-avatar"></div>
        </div>&nbsp;&nbsp;&nbsp;
        <div><a class="text-dark" href="/user/login">вход</a></div>&nbsp;&nbsp;
        <div><a class="text-dark" href="/user/signup">регистрация</a></div>
    </div>
</footer>
