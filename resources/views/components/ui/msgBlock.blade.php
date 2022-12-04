@php
$time = date('H:i');
@endphp
<audio preload="auto">
    <source src="{{ asset('audio/buben.mp3') }}" type="audio/mpeg">
    <source src="{{ asset('audio/buben.ogg') }}" type="audio/ogg">
</audio>
<!--Окно чата-->
<div id="msg-block" data-closed data-toggle="tooltip" data-trigger="manual"
     title="Добрый день,я Александр.Чем могу помочь ?">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
    <div id="msg-content">
        <div class="msg-closed">
            <div class="msg-icons-block">
                <span class="viber-icon viber d-block icon-item"></span>
                <span class="wats-icon wats d-block icon-item"></span>
                <span class="tg-icon tg d-block icon-item"></span>
            </div>
            <b class="msg-closed-text">Начните чат</b>
        </div>
        <img class="msg-img rounded-circle img-thumbnail" src="{{ asset('img/msg.png')  }}" alt="">
        <div class="msg-text">
            <div class="text-center text-info">Добрый день,я Александр.</div>
            <div class="text-center text-info">выберите мессенджер и начните чат</div>
            <i style="display:block;text-align: right;padding-right: .5em"><span class="check-all"></span>{{ $time }}</i>
        </div>
        <hr>
        <a class="msg-btn viber-bg" href="viber://chat?number=79876680484"
           target="_blank"><div class="viber-icon icon-large"></div> Viber</a>
        <a class="msg-btn watsap-bg" href="whatsapp://send?phone=79876680484"
           target="_blank"><div class="wats-icon icon-large"></div> Watsapp</a>
        <a class="msg-btn tg-bg" href="https://telegram.me/iskander_m21" target="_blank"><div class="tg-icon icon-large"></div> Telegram</a>
    </div>
</div>
