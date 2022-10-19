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
        <div class="msg-closed button-anim">
            &nbsp;&nbsp;&nbsp;<i class="fab fa-viber viber"></i> <i class="fab fa-whatsapp wats"></i> <i
                class="fab fa-telegram-plane tg"></i>
            <b class="msg-closed-text">Начните чат</b>
        </div>
        <img class="msg-img rounded-circle img-thumbnail" src="{{ asset('img/msg.png')  }}" alt="">
        <div class="msg-text">
            <div class="text-center">Добрый день,я Александр.</div>
            <div class="text-center text-info">выберите мессенджер и начните чат</div>
            <i style="display:block;text-align: right"><span
                    class="fa fa-check"></span>{{ $time }}</i>
        </div>
        <hr>
        <a class="msg-btn viber-bg" href="viber://chat?number=79876680484"
           target="_blank"><i class="fab fa-viber"></i> Viber</a>
        <a class="msg-btn watsap-bg" href="whatsapp://send?phone=79876680484"
           target="_blank"><i class="fab fa-whatsapp"></i> Watsapp</a>
        <a class="msg-btn tg-bg" href="https://telegram.me/iskander_m21" target="_blank"><i
                class="fab fa-telegram-plane"></i> Telegram</a>
    </div>
</div>
