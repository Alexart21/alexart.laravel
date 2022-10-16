<div id="contacts" class="anchors"></div>
<div class="h1 text-center">Возникли вопросы ?</div>
<div class="h2 text-center">Напишите нам и получите исчерпывающую консультацию.</div>
<br>
<form id="index-form"  action="{{ route('content.store') }}" method="post">
    @csrf
    <div class="field name-box animated bounceInDown wow" data-wow-delay="0.9s">
        <div class="form-group field-indexform-name required">
            <label class="control-label" for="indexform-name">Имя</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" tabindex="1">
            @error('name')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="field email-box animated bounceInDown wow" data-wow-delay="0.7s">
        <div class="form-group field-indexform-email required">
            <label class="control-label" for="indexform-email">Email</label>
            <input type="text" class="form-control" name="email" value="{{ old('email') }}" tabindex="2">
            @error('email')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="field tel-box animated bounceInDown wow" data-wow-delay="0.5s">
        <div class="form-group field-indexform-tel">
            <label class="control-label" for="indexform-tel">Тел.</label>
            <input type="text" class="form-control" name="tel" value="{{ old('tel') }}" tabindex="3"
                   data-plugin-inputmask="inputmask_0d647024">
        </div>
    </div>
    <div class="field msg-box animated bounceInDown wow" data-wow-delay="0.3s">
        <div class="form-group field-msg required">
            <label class="control-label" for="msg">Текст</label>
            <textarea id="msg" class="form-control" name="body" tabindex="4"> {{ old('body') }}</textarea>
            @error('body')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>
{{--    <input type="hidden" id="indexform-recaptcha" class="form-control" name="IndexForm[reCaptcha]">--}}
    {{--<div id="indexform-recaptcha-recaptcha-index-form" class="g-recaptcha"
         data-sitekey="6LfvSV0aAAAAAE9HX1TvZ9FRLPVPn_d1TeJNGxE5" data-input-id="indexform-recaptcha"
         data-form-id="index-form">
    </div>--}}
    <div class="form-group">
        <button type="submit" class="btn success-button animated bounceInDown wow" data-wow-delay="0.1s">Отправить
        </button>
    </div>
</form>
<script>
    /* Фиксируем "шторки" в контактной форме при фокусе */
    document.getElementById('index-form').addEventListener('focusin', (e) => {
        let el = e.target;
        let lbl = e.target.previousElementSibling; //<label>
        if (el.tagName != 'BUTTON') {
            // console.log(el);
            lbl.classList.add('fill');
        }
    });
    //
   /* "use strict";

    grecaptcha.ready(function() {
        grecaptcha.execute("6LftRl0aAAAAAHJDSCKdThCy1TaS9OwaGNPSgWyC", {action: "index"}).then(function(token) {
            jQuery("#" + "indexform-recaptcha").val(token);

            const jsCallback = "";
            if (jsCallback) {
                eval("(" + jsCallback + ")(token)");
            }
        });
    });*/
</script>
