@php
    $rateLimit = 5;
    $siteKey = config('grecaptcha.recaptcha_v3_site_key');
@endphp
<div id="callback" class="modal" data-backdrop="static" style="padding-right: 17px;>
    <div class="modal-dialog=true" role="document">
<div class="modal-content" style="opacity: 1; display: block; transform: scaleX(1) scaleY(1);">
    <div class="modal-header">
        <h3>Укажите Ваш номер телефона и мы свяжемся с Вами</h3>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
    </div>
    <div class="modal-body">
        <div class="row" style="padding: 1em">
            <form id="call-form" action="{{ route('zvonok.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <input id="callInp" list="callNames" type="text" class="form-control" name="name" placeholder="Ваше имя">
                    <datalist id="callNames">
                    </datalist>
                    <div id="name-err-call" class="call-err-msg text-danger"></div>
                </div>

                <div class="form-group">
                    <input type="text" id="call-tel" class="form-control" name="tel">
                    <div id="tel-err-call" class="call-err-msg text-danger"></div>
                </div>
                <div class="form-group">
                    <label for="mode">Предпочтительный способ связи:</label>
                    <select name="mode">
                        <option selected value="ph">по телефону</option>
                        <option value="tg">через Telegramm</option>
                        <option value="wt">через Watsapp</option>
                    </select>
                    <div id="mode-err-call" class="call-err-msg text-danger"></div>
                </div>
                <input type="hidden" id="callform-recaptcha" name="reCaptcha"/>
                <div id="reCaptcha-err-call" class="call-err-msg text-danger"></div>
                <input type="hidden" name="subject" value="call" />
                <div id="subject-err-call" class="call-err-msg text-danger"></div>
                <div class="form-group">
                    <div class="form-loader"></div>
                    <button id="callSubmit" type="submit" class="btn success-button">жду звонка!</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
<script>
    // functions
    function startFormLoader(form) {
        let loader = form.querySelector('.form-loader');
        let btn = form.querySelector('button');
        loader.style.display = 'inline-block';
        btn.disabled = true;
    }

    function stopFormLoader(form) {
        let loader = form.querySelector('.form-loader');
        let btn = form.querySelector('button');
        loader.style.display = 'none';
        btn.disabled = false;
    }
    // DADAta
    let callInp = document.getElementById('callInp');
    let callNames = document.getElementById('callNames');
    let csrf = document.getElementById('_csrf_token').content; // объявлен в шаблоне
    let callFormUrl = "{{ route('zvonok.info') }}";
    callInp.addEventListener('input', (e) => {
        let name = e.target.value;
        if (name.length > 2) { // со скольки букв начинать подсказку
            fetchDaData(name, callFormUrl, csrf, callNames); // в scripts.js описано
        }
    });
    // end DADAta
    // FETCH отправка формы
    let callForm = document.getElementById('call-form');

    callForm.onsubmit = (e) => {
        e.preventDefault();
        startFormLoader(callForm);
        clearErrMsgs('call-err-msg');
        try { // обертка в try/catch не обязательна. Это лишь что бы при локальной работе не было ошибок с reCaptcha
            grecaptcha.ready(function () {
                // сам скрипт с google подключается в щаблоне resources/views/components/layouts/main.blade.php
                grecaptcha
                    .execute("{{ $siteKey }}", {
                        action: "post",
                    })
                    .then(async function (token) {
                        /* Все дальнейшие операции только после получения reCaptcha токена !!! */
                        let inp = document.getElementById("callform-recaptcha");
                        inp.value = token;
                        let formData = new FormData(callForm);
                        let response = await fetch("{{ route('zvonok.store') }}", {
                            method: 'POST',
                            body: formData
                        })
                        .finally(() => {
                            stopFormLoader(callForm);
                        });
                        let msgBlock = document.getElementById('modal-msg'); // сюда в модалке выводим сообщенмя успех/ошибка
                        let result;
                        if (!response.ok) {
                            console.log(response);
                            if (response.status == 422) { // ошибки валидации
                                result = await response.json();
                                console.log('validate errors');
                                let errors = result.errors;
                                for (let key in errors) {
                                    try {
                                        let errBlock = document.getElementById(key + '-err-call');
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
                                setTimeout(() => {
                                    callForm.reset();
                                }, 2000);
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
                                setTimeout(() => {
                                    callForm.reset();
                                    $('#callback').modal('hide');
                                }, 2000);
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
            stopFormLoader(callForm)
            console.log(error);
        }
    }
</script>
