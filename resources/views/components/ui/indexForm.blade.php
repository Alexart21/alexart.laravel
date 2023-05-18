@php
    $rateLimit = 5;
    $siteKey = config('grecaptcha.recaptcha_v3_site_key');;
@endphp
<div id="contacts" class="anchors"></div>
<div class="h1 text-center">Возникли вопросы ?</div>
<div class="h2 text-center">Напишите нам и получите исчерпывающую консультацию.</div>
<br>
<form id="index-form" action="{{ route('mail.store') }}" method="post">
    @csrf
    <div class="field name-box animated bounceInDown wow" data-wow-delay="0.9s">
        <div class="form-group field-indexform-name required">
            <label class="control-label" for="indexform-name">Имя</label>
            <input id="nameInp" list="indexNames" type="text" class="form-control" name="name" value="{{ old('name') }}"
                   tabindex="1">
            <datalist id="indexNames">
            </datalist>
            @error('name')
            <div class="err-msg text-danger">{{ $message }}</div>@enderror
            {{--       этот div для AJAX отправки формы (предидущий блок разметка с сервера не приходит) сюда с помощью JS вставляем сообщение об ошибках     --}}
            <div id="name-err-index" class="index-err-msg text-danger"></div>
        </div>
    </div>
    <div class="field email-box animated bounceInDown wow" data-wow-delay="0.7s">
        <div class="form-group field-indexform-email required">
            <label class="control-label" for="indexform-email">Email</label>
            <input type="text" class="form-control" name="email" value="{{ old('email') }}" tabindex="2">
            @error('email')
            <div class="text-danger">{{ $message }}</div>@enderror
            {{--       этот div для AJAX отправки формы (предидущий блок разметка с сервера не приходит) сюда с помощью JS вставляем сообщение об ошибках     --}}
            <div id="email-err-index" class="index-err-msg text-danger"></div>
        </div>
    </div>
    <div class="field tel-box animated bounceInDown wow" data-wow-delay="0.5s">
        <div class="form-group field-indexform-tel">
            <label class="control-label" for="indexform-tel">Тел.</label>
            <input id="tel" type="text" class="form-control" name="tel" value="{{ old('tel') }}" tabindex="3"
                   data-plugin-inputmask="inputmask_0d647024">
            {{--       этот div для AJAX отправки формы (предидущий блок разметка с сервера не приходит) сюда с помощью JS вставляем сообщение об ошибках     --}}
            <div id="tel-err-index" class="index-err-msg text-danger"></div>
        </div>
    </div>
    <div class="field msg-box animated bounceInDown wow" data-wow-delay="0.3s">
        <div class="form-group field-msg required">
            <label class="control-label" for="msg">Текст</label>
            <textarea id="msg" class="form-control" name="body" tabindex="4"> {{ old('body') }}</textarea>
            @error('body')
            <div class="text-danger">{{ $message }}</div>@enderror
            {{--       этот div для AJAX отправки формы (предидущий блок разметка с сервера не приходит) сюда с помощью JS вставляем сообщение об ошибках     --}}
            <div id="body-err-index" class="index-err-msg text-danger"></div>
        </div>
    </div>
    <input type="hidden" id="rc" name="reCaptcha"/>
    <div id="reCaptcha-err-index" class="index-err-msg text-danger"></div>
    <div class="form-group">
        <div class="form-loader"></div>
        <button type="submit" class="btn success-button animated bounceInDown wow" data-wow-delay="0.1s">Отправить
        </button>
    </div>
</form>
<script>
    // DADAta эксперименты
    let nameInp = document.getElementById('nameInp');
    let indexNames = document.getElementById('indexNames');
    let token = document.getElementById('_csrf_token').content; // объявлен в шаблоне
    let indexFormUrl = "{{ route('post.info') }}";
    nameInp.addEventListener('input', (e) => {
        let name = e.target.value;
        if (name.length > 2) { // со скольки букв начинать подсказку
            fetchDaData(name, indexFormUrl, token, indexNames); // в scripts.js описано
        }
    });
    // end DADAta
    /* Фиксируем "шторки" в контактной форме при фокусе */
    document.getElementById('index-form').addEventListener('focusin', (e) => {
        let el = e.target;
        let lbl = e.target.previousElementSibling; //<label>
        if (el.tagName != 'BUTTON') {
            // console.log(el);
            lbl.classList.add('fill');
        }
    });
    // FETCH отправка формы
    let indexForm = document.getElementById('index-form');

    indexForm.onsubmit = (e) => {
        e.preventDefault();
        clearErrMsgs('index-err-msg');
        // ф-ия описана в компоненте seoForm.blade.php
        startFormLoader(indexForm);
        try { // обертка в try/catch не обязательна. Это лишь что бы при локальной работе не было ошибок с reCaptcha
            grecaptcha.ready(function () {
                // сам скрипт с google подключается в щаблоне resources/views/components/layouts/main.blade.php
                grecaptcha
                    .execute("{{ $siteKey }}", {
                        action: "post",
                    })
                    .then(async function (token) {
                        /* Все дальнейшие операции только после получения reCaptcha токена !!! */
                        let inp = document.getElementById("rc");
                        inp.value = token;
                        let formData = new FormData(indexForm);
                        let response = await fetch("{{ route('mail.store') }}", {
                            method: 'POST',
                            body: formData
                        })
                            .finally(() => {
                                // ф-ия описана в компоненте seoForm.blade.php
                                stopFormLoader(indexForm);
                            });
                        let result;
                        if (!response.ok) {
                            console.log(response);
                            if (response.status == 422) { // ошибки валидации
                                result = await response.json();
                                console.log('validate errors');
                                let errors = result.errors;
                                for (let key in errors) {
                                    try {
                                        let errBlock = document.getElementById(key + '-err-index');
                                        errBlock.innerText = errors[key][0];
                                    } catch (e) {
                                        continue;
                                    }
                                }
                            } else { // при ошибках 500 или других придет html страница ошибки а не json. Оповещаем и останавливаем
                                $.toaster({
                                    priority: 'danger',
                                    title: `${response.status} ${response.statusText}`,
                                    message: ''
                                });
                                console.log(response);
                            }
                            return;
                        } else { // статус 200
                            result = await response.json();
                            if (result.success) { // успешно
                                $.toaster({
                                    priority: 'success',
                                    title: 'Спасибо, заявка принята!',
                                    message: '',
                                });
                                beep();
                            } else { // фиг знает че за ошибка
                                $.toaster({
                                    priority: 'danger',
                                    title: 'Ошибка сервера!',
                                    message: ''
                                });
                                console.log(response);
                            }
                        }
                    });
            });
        } catch (error) {
            // ф-ия описана в компоненте seoForm.blade.php
            stopFormLoader(indexForm);
            console.log(error);
        }
    }
</script>
