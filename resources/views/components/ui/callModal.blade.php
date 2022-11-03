@php
    $rateLimit = env('All_FORMS_RATE_LIMIT', 10);
    $siteKey = env('RECAPTCHA_V3_SITE_KEY');
@endphp
<div id="callback" class="modal" style="padding-right: 17px;>
    <div class=" modal-dialog" role="document">
<div class="modal-content" style="opacity: 1; display: block; transform: scaleX(1) scaleY(1);">
    <div class="modal-header">
        <h3>Укажите Ваш номер телефона и мы перезвоним Вам</h3>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
    </div>
    <div class="modal-body">
        <div class="row" style="padding: 1em">
            <form id="call-form" action="{{ route('call.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Ваше имя">
                    <div id="name-err-call" class="call-err-msg text-danger"></div>
                </div>

                <div class="form-group">
                    <input type="text" id="call-tel" class="form-control" name="tel">
                    <div id="tel-err-call" class="call-err-msg text-danger"></div>
                </div>
                <input type="hidden" id="callform-recaptcha" name="reCaptcha"/>
                <div class="form-group">
                    <button id="callSubmit" type="submit" class="btn success-button button-anim">жду звонка!</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
<script>
    // FETCH отправка формы
    let callForm = document.getElementById('call-form');

    callForm.onsubmit = (e) => {
        e.preventDefault();
        startLoader();
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
                        let response = await fetch("{{ route('call.store') }}", {
                            method: 'POST',
                            body: formData
                        });
                        let msgBlock = document.getElementById('modal-msg'); // сюда в модалке выводим сообщенмя успех/ошибка
                        let result;
                        if (!response.ok) {
                            stopLoader();
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
                                // переменная $rateLimit установлена в шаблоне resources/views/components/layouts/main.blade.php
                                let rateLimit = {{ $rateLimit }};
                                showServerError(msgBlock, response.status, response.statusText, rateLimit);
                                console.log(response);
                            }
                            return;
                        } else { // статус 200
                            stopLoader();
                            result = await response.json();
                            if (result.success) { // успешно
                                console.log('form submitted');
                                showSuccess(msgBlock, callForm);
                            } else { // фиг знает че за ошибка
                                if (!result.recaptcha) {
                                    console.log('recaptcha error');
                                } else if (!result.db) {
                                    showDbError(msgBlock);
                                    console.log('db error');
                                } else if (!result.mail) {
                                    console.log('email send error')
                                }
                                console.log(response);
                            }
                        }
                    });
            });
        } catch (error) {
            console.log(error);
        }
    }
</script>
