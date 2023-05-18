@php
    $siteKey = config('grecaptcha.recaptcha_v3_site_key');
    $mode = [
        'ph' => 'по телефону',
        'tg' => 'через Telegramm',
        'wt' => 'через Watsapp',
    ];
@endphp
<x-form id="seo-form">
    <x-form-input name="name" label="Имя"/>
    <div id="name-err-seo" class="text-danger seo-err-msg"></div>
    <x-form-input id="seo-tel" name="tel" label="Телефон"/>
    <div id="tel-err-seo" class="text-danger seo-err-msg"></div>
    <input type="hidden" id="seoform-recaptcha" name="reCaptcha"/>
    <input type="hidden" name="subject" value="seo" />
    <div id="subject-err-seo" class="seo-err-msg text-danger"></div>
    <br>
    <x-form-select name="mode" :options="$mode" label="Предпочтительный способ связи:" />
    <div id="mode-err-seo" class="seo-err-msg text-danger"></div>
    <br>
    <br>
    <x-form-submit>
        <div class="form-loader"></div>
        <span class="text-white-500">Отправить</span>
    </x-form-submit>
</x-form>
<script>
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

    let seoFormUrl = "{{ route('zvonok.store') }}";
    let seoForm = document.getElementById('seo-form');
    seoForm.onsubmit = (e) => {
        e.preventDefault();
        clearErrMsgs('seo-err-msg');
        startFormLoader(seoForm);
        grecaptcha.ready(function () {
            grecaptcha
                .execute("{{ $siteKey }}", {
                    action: "post",
                })
                .then(async function (token) {
                    /!* Все дальнейшие операции только после получения reCaptcha токена !!! *!/
                    let inp = document.getElementById("seoform-recaptcha");
                    inp.value = token;
                    let formData = new FormData(seoForm);
                    let response = await fetch(seoFormUrl, {
                        method: 'POST',
                        body: formData
                    })
                        .finally(() => {
                            stopFormLoader(seoForm);
                        });
                    if (response.ok) {
                        result = await response.json();
                        if (result.success) { // успешно
                            $.toaster({
                                priority: 'success',
                                title: 'Спасибо, заявка принята!',
                                message: '',
                            });
                            beep();
                            setTimeout(() => {
                                seoForm.reset();
                            }, 2000);
                        }
                    } else {
                        if (response.status == 422) { // ошибки валидации
                            result = await response.json();
                            console.log('validate errors');
                            let errors = result.errors;
                            for (let key in errors) {
                                try {
                                    let errBlock = document.getElementById(key + '-err-seo');
                                    errBlock.innerText = errors[key][0];
                                } catch (e) {
                                    continue;
                                }
                            }
                        } else { // при ошибках 500 или других придет html страница ошибки а не json. Оповещаем и останавливаем
                            $.toaster({
                                priority: 'danger',
                                title: 'Ошибка сервера!',
                                message: ''
                            });
                        }
                    }
                    console.log(response);
                })
        });
    }
</script>
