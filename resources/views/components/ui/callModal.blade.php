@php
    $rateLimit = env('FORMS_RATE_LIMIT');
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
        startLoader()
        // очистка сообщений об ошибках
        msgs = document.getElementsByClassName('call-err-msg');
        let i = 0;
        while (msgs[i]) {
            msgs[i].innerHTML = '';
            i++;
        }
        try { // обертка в try/catch не обязательна. Это лишь что бы при локальной работе не было ошибок с reCaptcha
            grecaptcha.ready(function () {
                // сам скрипт с google подключается в щаблоне resources/views/components/layouts/main.blade.php
                grecaptcha
                    .execute("6LftRl0aAAAAAHJDSCKdThCy1TaS9OwaGNPSgWyC", {
                        action: "call",
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
                        let msg = document.getElementById('modal-msg');
                        // let result = await response.text();
                        if (!response.ok) { // при ошибках 500 или других придет html страница ошибки а не json. Оповещаем и останавливаем
                            stopLoader();
                            console.log(response);
                            // переменная $rateLimit установлена в шаблоне resources/views/components/layouts/main.blade.php
                            let errMsg = response.status == 429 ? 'Лимит исчерпан. Не более ' + {{ $rateLimit }} + ' запросов в минуту' : `Ошибка ${response.status} ${response.statusText}`;
                            msg.innerHTML = '<span style="color: red">' + errMsg + '</span>';
                            $('#successModal').modal('show');
                            $('#successModal .modal-content').velocity('transition.bounceIn');
                            setTimeout(() => {
                                msg.innerHTML = '';
                                $('#successModal').modal('hide');
                            }, 8000);
                            return;
                        }
                        let result = await response.json();
                        // result = JSON.parse(result);
                        if (response.ok) {
                            stopLoader();
                            // loader.style.display = 'none';
                            if (result.success) { // успешно провалидировано
                                if (!result.db) { // почемуто не записалось в базу
                                    msg.innerHTML = '<span style="color: red">Ошибка базы данных!</span>';
                                    $('#successModal').modal('show');
                                    $('#successModal .modal-content').velocity('transition.bounceIn');
                                    setTimeout(() => {
                                        msg.innerHTML = '';
                                        $('#successModal').modal('hide');
                                    }, 8000);
                                    return;
                                }
                                console.log('form submitted');
                                callForm.reset();
                                msg.innerHTML = '<span style="color: green">Спасибо, сообщение отправлено!</span>';
                                $('#callback').modal('hide');
                                $('#successModal').modal('show');
                                setTimeout(() => {
                                    msg.innerHTML = '';
                                    $('#successModal').modal('hide');
                                }, 4000);
                            } else { // ошибки валидации
                                console.log('errors');
                                let errors = result.errors;
                                for (let key in errors) {
                                    try {
                                        let errBlock = document.getElementById(key + '-err-call');
                                        errBlock.innerText = errors[key][0];
                                    } catch (e) {
                                        continue;
                                    }
                                }
                            }
                        } else {
                            stopLoader();
                            console.log(response);
                        }
                    });
            });
        } catch (error) {
            console.log(error);
        }
    }
</script>
