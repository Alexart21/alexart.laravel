<div id="callback" class="fade modal show" role="dialog" tabindex="-1" aria-labelledby="callback-label"
     style="padding-right: 17px; display: block;" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="opacity: 1; display: block; transform: scaleX(1) scaleY(1);">
            <div class="modal-header">
                <h3>УкажитеW Ваш номер телефона и мы перезвоним Вам</h3>
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
    //     $("#call-tel").mask("+7(___) ___-__-__");
    // FETCH отправка формы
    let callForm = document.getElementById('call-form');
    // let callSubmit = document.getElementById('callSubmit');
    callForm.onsubmit = (e) => {
        // destroyErrMsg();
        e.preventDefault();
        console.log('here');
        /*// return;
        // let loader = document.getElementById('container_loading');
        // loader.style.display = 'block';
        let formData = new FormData(callForm);
        let response =  fetch("{{ route('call.store') }}", {
            method: 'POST',
            body: formData
        });
        // let result = await response.text();
        let result =  response.json();
        // result = JSON.parse(result);
        if (response.ok) {
            // loader.style.display = 'none';
            if (result.success) { // успешно
                console.log('form submitted');
                // $('#successModal').modal('show');
                // $('.modal-content').velocity('transition.bounceIn');
                // form.reset();
                /!*setTimeout(() => {
                    $('#successModal').modal('hide');
                }, 4000)*!/
            } else { // ошибки валидации
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
            console.log(response);
            // loader.style.display = 'none';
        }
        */
        return false;
    }
    // очистка сообщений об ошибках
    /*function destroyErrMsg() {
        msgs = document.getElementsByClassName('index-err-msg');
        let i = 0;
        while (msgs[i]) {
            msgs[i].innerHTML = '';
            i++;
        }
    }*/
</script>
