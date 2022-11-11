@php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();
    if($user){
        if($user->profile_photo_path){
           $avatar = '/storage/' . $user->profile_photo_path;
        }elseif ($user->avatar){
            $avatar = $user->avatar;
        }else{
           $avatar = '/upload/default_avatar/no-image.png';
        }
    }
@endphp
<footer class="innerShadow gradient3">
    <strong class="company">Alex-art21</strong><sup>&copy;</sup> web developer group 2009&mdash;{{ date('Y') }} тел. <b
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
    @auth()
        <div class="d-flex justify-content-center user-block">
            &nbsp;
            <div><a href="/user/profile" title="личный кабинет">
                    <img src="{{ $avatar }}" alt="" class="avatar rounded-circle img-thumbnail">
                </a>
            </div>
            &nbsp;&nbsp;<div class="username"><a href="/user/profile" title="личный кабинет"
                                                 class="text-dark">{{ $user->name }}</a></div>
            &nbsp;&nbsp;
            {{-- Окошко подтверждения выхода --}}
            <x-ui.dialog />
            {{-- кнопка выход методом POST --}}
            <x-ui.logout-link />
        </div>
    @else
        <div class="d-flex justify-content-center user-block">
            <div>
                <div class="no-avatar"></div>
            </div>&nbsp;&nbsp;&nbsp;
{{--            <div class="username text-dark">Гость</div>--}}
            <div><a class="text-dark" href="/login">вход</a></div>&nbsp;&nbsp;
            <div><a class="text-dark" href="/register">регистрация</a></div>
        </div>
    @endif
</footer>
